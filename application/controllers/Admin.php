<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('database_model');
		$this->mynav = TRUE; //true=implement side-nav to all pages
		$this->css[] = base_url() . "resources/app/css/bootstrap.css";
		$this->css[] = base_url() . "resources/app/css/app.css";
		// $this->js[] = base_url() . "resources/app/app.js";
		// $this->css[] = "resources/vendor/fontawesome/css/font-awesome.min.css";
		// $this->css[] = "resources/vendor/animo/animate+animo.css";
		$this->css[] = base_url() . "resources/vendor/csspinner/csspinner.min.css";
		// $this->js[] = "resources/vendor/modernizr/modernizr.js";
		// $this->js[] = "resources/vendor/fastclick/fastclick.js";
		$this->not_logged_in();
		$this->viewnav = "admin/nav";
    }
	
	public function not_logged_in()
	{
		if( !$this->session->userdata('email') )
		{
			redirect(base_url().'login', 'refresh');
		}
		else
		{
			$this->not_admin();
		}
		
	}
	
	private function not_admin()
	{
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		$user_type = $query[0]->user_type;
		if($user_type != 'admin')
		{
			redirect(base_url().'login', 'refresh');
		}
	}
	
	public function index()
	{
		$data['text_result'] = $this->database_model->get_usage_admin(1);
		$this->_render('admin/stats',$data);
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect(base_url().'login', 'refresh');
	}
	
	public function users()
	{
		$data['user_list'] = $this->database_model->get_user_list();
		$this->_render('admin/users',$data);
	}
	
	public function users_monthstats()
	{
		$num = $this->input->post('num');
		$apikey = $this->input->post('apikey');
		echo json_encode($this->database_model->get_usage_users($num,$apikey));
	}
	
	public function stats_plus_billing()
	{
		$stats_bill = array();
		$num = $this->input->post('num');
		$apikey = $this->input->post('apikey');
		
		$stats_bill['stats'] = $this->database_model->get_usage_users($num,$apikey);
		$stats_bill['billing'] = $this->database_model->get_billing_history($apikey);
		
		echo json_encode($stats_bill);
	}
	
	public function stats(){

		$data['text_result'] = $this->database_model->get_usage_admin(1);

		$this->_render('admin/stats',$data);
	}

	public function adminsettings()
	{
		$this->_render('admin/adminsettings');
	}
	
	public function monthstats()
	{
		$num = $this->input->post('num');
		echo json_encode($this->database_model->get_usage_admin($num));
	}

	public function account_change_password()
	{
		$arr_return = array();
		$old_pass = $this->input->post('old_pass');
		$new_pass = $this->input->post('new_pass');
		$cfrm_pass = $this->input->post('cfrm_pass');
		$data = array( 
		'email' => $this->session->userdata('email'),
		'password' => $old_pass );
		$return = $this->database_model->login($data);
		if( $return )
		{
			$this->database_model->change_password( $this->session->userdata('email'),$new_pass );
			echo true;
		}
		else
		{
			echo false;
		}
		
	}
	
	public function income_stats()
	{
		$data['billed_dates'] = json_encode($this->database_model->get_all_billed_dates());
		$data['income_result'] = json_encode($this->database_model->get_income_result());
		$data['unpaid_result'] = json_encode($this->database_model->get_unpaid_result());
		// $data['min_date'] = date('Y-m-d' ,strtotime('+1 day',strtotime($this->database_model->last_billed_date()) ));
		// $datetime = new DateTime('tomorrow');
		// $data['tomorrow'] = $datetime->format('F j, Y');
		// $data['tomorrow'] = date('Y-m-d');
		$this->_render('admin/income_stats',$data);
	}
	
	public function get_billing_info()
	{
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$return = array();
		
		$datestring = strtotime($year.'-'.$month.'-01');
		$day1 = date('Y-m-01',$datestring);

		$result = $this->database_model->get_billed_bymonth($day1);
		
		echo json_encode($result);
		// id name email usage amount
	}
	
	public function batch_billing()
	{
		$this->load->model('computation_model');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$return = array();
		
		$datestring = strtotime($year.'-'.$month.'-01');
		$day1 = date('Y-m-01',$datestring);
		$daylast = date('Y-m-t',$datestring);
		
		if( date('Y-m-d') > $daylast )
		{
			// echo json_encode($return);
			$result = $this->database_model->get_billing_month($day1,$daylast);
			for($x=0;$x<sizeof($result);$x++)
			{
				$result[$x]['total'] = $total = $result[$x]['definition'] + $result[$x]['text'] + $result[$x]['trans'] + $result[$x]['word'];
				$result[$x]['billing_date'] = $day1;
				$result[$x]['amount'] = $this->computation_model->compute_length($total);
				$result[$x]['billing_date_issue'] = date('Y-m-d H:i:s');
				$this->database_model->insert_billing($result[$x]);
				
				$data['billing_data'] = $result[$x];
				$config['mailtype'] = 'html';
				$config['charset']  = 'UTF-8';
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->clear();
				$this->email->from('vocadb.api@gmail.com');
				$sentto = array();
				$sentto[] = $result[$x]['email'];
				$this->email->to($sentto);
				$this->email->subject('VocaDB Billing as of '.date('F, Y',strtotime($day1) ));
				$this->email->message($this->load->view("admin/send_billing",$data,true));
				$this->email->send();
			}
			echo TRUE;
		}
		else
		{
			echo FALSE;
		}
	}
	public function batch_billing_result()
	{
		$this->load->model('computation_model');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$return = array();
		
		$datestring = strtotime($year.'-'.$month.'-01');
		$day1 = date('Y-m-01',$datestring);
		$daylast = date('Y-m-t',$datestring);
		
		if( date('Y-m-d') > $daylast )
		{
			// echo json_encode($return);
			$result = $this->database_model->get_billing_month($day1,$daylast);
			for($x=0;$x<sizeof($result);$x++)
			{
				$result[$x]['total'] = $total = $result[$x]['definition'] + $result[$x]['text'] + $result[$x]['trans'] + $result[$x]['word'];
				$result[$x]['billing_date'] = $day1;
				$result[$x]['amount'] = $this->computation_model->compute_length($total);
				$result[$x]['billing_date_issue'] = date('Y-m-d H:i:s');
			}
		}
		echo json_encode($result);
	}
	
	public function billing_resend()
	{
		$bill_info = json_decode( $this->input->post('bill_info') );
		foreach($bill_info as $v)
		{
			$bill_data = json_decode($v);
			$date_issue = date('Y-m-d H:i:s');
			$email = $bill_data->email;

			// $this->database_model->reissue_billing($bill_data->billing_id,$date_issue);
			
			$insert_data = array(
				'billing_id' => $bill_data->billing_id,
				'total' => $bill_data->total,
				'definition' => $bill_data->definition,
				'text' => $bill_data->text,
				'word' => $bill_data->word,
				'trans' => $bill_data->trans,
				'amount' => $bill_data->amount,
				'apikey' => $bill_data->apikey,
				'billing_date' => $bill_data->billing_date,
				'billing_date_issue' => $date_issue
			);
			$data['billing_data'] = $insert_data;
			$config['mailtype'] = 'html';
			$config['charset']  = 'UTF-8';
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->clear();
			$this->email->from('vocadb.api@gmail.com');
			$sentto = array();
			$sentto[] = $email;
			$this->email->to($sentto);
			$this->email->subject('VocaDB Billing as of '.date('F, Y',strtotime($bill_data->billing_date) ));
			$this->email->message($this->load->view("admin/send_billing",$data,true));
			$this->email->send();
		}
	}
	
	public function get_all_billed_users()
	{
		$result = array();
		
		$result = $this->database_model->get_unpaid_billedusers();
		// for($x=0;$x<sizeof($result);$x++)
		// {
			// $result[$x]['billing_date'] = date('F Y',strtotime( $result[$x]['billing_date'] ) );
			// $result[$x]['billing_date_issue'] = date('F j, Y, g:i a', strtotime($result[$x]['billing_date_issue']) );
		// }
		echo json_encode($result);
	}
	
	public function billing_reissue()
	{
		$alldata = json_decode($this->input->post('bill_info'));
		foreach($alldata as $v)
		{
			$bill_data = json_decode($v);
			$date_issue = date('Y-m-d H:i:s');
			$email = $bill_data->email;

			$this->database_model->reissue_billing($bill_data->billing_id,$date_issue);
			
			$insert_data = array(
				'billing_id' => $bill_data->billing_id,
				'total' => $bill_data->total,
				'definition' => $bill_data->definition,
				'text' => $bill_data->text,
				'word' => $bill_data->word,
				'trans' => $bill_data->trans,
				'amount' => $bill_data->amount,
				'apikey' => $bill_data->apikey,
				'billing_date' => $bill_data->billing_date,
				'billing_date_issue' => $date_issue
			);
			$data['billing_data'] = $insert_data;
			$config['mailtype'] = 'html';
			$config['charset']  = 'UTF-8';
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->clear();
			$this->email->from('vocadb.api@gmail.com');
			$sentto = array();
			$sentto[] = $email;
			$this->email->to($sentto);
			$this->email->subject('VocaDB re-Billing as of '.date('F, Y',strtotime($bill_data->billing_date) ));
			$this->email->message($this->load->view("admin/resend_billing",$data,true));
			$this->email->send();
		}
	}
}
?>