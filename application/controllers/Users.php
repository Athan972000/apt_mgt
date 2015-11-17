<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('database_model');
		$this->mynav = TRUE; //true=implement side-nav to all pages
		$this->css[] = base_url() . "resources/app/css/bootstrap.css";
		$this->css[] = base_url() . "resources/app/css/app.css";
		// $this->css[] = "resources/vendor/fontawesome/css/font-awesome.min.css";
		// $this->css[] = "resources/vendor/animo/animate+animo.css";
		// $this->css[] = base_url() . "resources/vendor/csspinner/csspinner.min.css";
		// $this->js[] = "resources/vendor/modernizr/modernizr.js";
		// $this->js[] = "resources/vendor/fastclick/fastclick.js";
		$this->not_logged_in();
		$this->viewnav = "user/nav";
    }
	
	public function not_confirmed() //not_logged_in v1
	{
		if( $this->session->userdata('confirm') == 0 )
		{
			if( uri_string() != 'confirm' && uri_string() != 'contact' && uri_string() != 'accountsettings' && uri_string() != 'logout' )
			{
				redirect(base_url().'confirm', 'refresh');
			}
		}
		// else if( !$this->session->has_userdata('email') )
		// {
			// redirect(base_url().'login', 'refresh');
		// }
	}
	
	public function not_logged_in() //not_logged_in v2
	{
		if( !$this->session->has_userdata('email') )
		{
			redirect(base_url().'login', 'refresh');
		}
	}
	
	public function confirm()
	{
        // redirect(base_url(), 'refresh');
		$data['email'] = $this->session->userdata('email');
		$this->_render('user/confirm_require',$data);
		$confirm = $this->database_model->check_confirmation_email( $this->session->userdata('email') );
		if( $confirm )
		{
			$this->session->set_userdata('confirm', 1);
			redirect(base_url(),'refresh');
		}
	}
	
	public function index()
	{
		$this->not_confirmed();
        $query = $this->database_model->read_user_information($this->session->userdata('email'));
		$data['text_result'] = $this->database_model->get_usage_users(1,$query[0]->apikey);
		$data['api_key'] = $query[0]->apikey;
		$this->_render('user/stats',$data);
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect(base_url().'login', 'refresh');
	}
	
	public function feat()
	{
		redirect(base_url());
	}
	
	public function faq()
	{
		$this->not_confirmed();
		$this->_render('user/faq');
	}
	
	// public function stats(){
		// $query = $this->database_model->read_user_information($this->session->userdata('email'));
		// $data['text_result'] = $this->database_model->get_usage_users(1,$query[0]->apikey);
		// $this->_render('user/stats',$data);
	// }
	
	public function monthstats_users()
	{
		$num = $this->input->post('num');
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		echo json_encode($this->database_model->get_usage_users($num,$query[0]->apikey));
	}

	public function billing()
	{
		$this->load->model('computation_model');
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		$api_key = $query[0]->apikey;
		
		$billing = $this->database_model->get_billing_user($api_key);
		$remaining_balance = 0;
		$current = 0;
		$ctr = false;
		$notpaid_bill = array();
		foreach($billing as $v)
		{
			if($v['amount_paid'] == null)
			{
				$notpaid_bill[$v['billing_id']] = $v['amount'];
			}
			if($ctr)
			{
				$remaining_balance += $v['amount'] - $v['amount_paid'];
			}
			else
			{
				$current = $v['amount'] - $v['amount_paid'];
				$data['text_amount'] = $this->computation_model->compute_length($v['text']);
				$data['definition_amount'] =  $this->computation_model->compute_length($v['definition']) ;			
				$data['word_amount'] = $this->computation_model->compute_length( $v['word'] );
			}
			$ctr = true;
		}
		$data['current'] = $current;
		$data['remaining_bal'] = $remaining_balance;
		$data['notpaid_bill'] = json_encode($notpaid_bill);
		$data['total_amount'] = $remaining_balance + $current;
		// history
		$data['billing_history'] = $this->database_model->get_billing_history($api_key);
		
		$this->_render('user/billing',$data);
	}
	
	public function billing_complete()
	{
		$tx = $this->input->get('tx');
		$your_pdt_identity_token = 'oNud59a3chLZxSNb5_wIsMIStzB9_2OHGYHbZjkl37aXPDzXA4b9y_0n3Gi';
		
		// Init cURL
		$request = curl_init();

		// Set request options
		curl_setopt_array($request, array
		(
		  CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
		  CURLOPT_POST => TRUE,
		  CURLOPT_POSTFIELDS => http_build_query(array
			(
			  'cmd' => '_notify-synch',
			  'tx' => $tx,
			  'at' => $your_pdt_identity_token,
			)),
		  CURLOPT_RETURNTRANSFER => TRUE,
		  CURLOPT_HEADER => FALSE,
		  // CURLOPT_SSL_VERIFYPEER => TRUE,
		  // CURLOPT_CAINFO => 'cacert.pem',
		));

		// Execute request and get response and status code
		$response = curl_exec($request);
		$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

		// Close connection
		curl_close($request);
		
		if($status == 200 AND strpos($response, 'SUCCESS') === 0)
		{
			// Further processing
			// Remove SUCCESS part (7 characters long)
			$response = substr($response, 7);

			// URL decode
			$response = urldecode($response);

			// Turn into associative array
			preg_match_all('/^([^=\s]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);
			$response = array_combine($m[1], $m[2]);

			// Fix character encoding if different from UTF-8 (in my case)
			if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')
			{
			  foreach($response as $key => &$value)
			  {
				$value = mb_convert_encoding($value, 'UTF-8', $response['charset']);
			  }
			  $response['charset_original'] = $response['charset'];
			  $response['charset'] = 'UTF-8';
			}

			// Sort on keys for readability (handy when debugging)
			ksort($response);
			// echo "<pre>";
			// print_r($response);
			// exit();
			/*
			Array
			(
				[business] => athan17@gmail.com
				[charset] => UTF-8
				[charset_original] => windows-1252
				[custom] => 
				[first_name] => Jonathan
				[handling_amount] => 0.00
				[item_name] => Billing - VocaDB API
				[item_number] => 
				[last_name] => Subion
				[mc_currency] => USD
				[mc_fee] => 0.34
				[mc_gross] => 1.37
				[payer_email] => Athan972000@yahoo.com
				[payer_id] => 49K3JMVVABNR4
				[payer_status] => verified
				[payment_date] => 19:06:47 Nov 16, 2015 PST
				[payment_fee] => 0.34
				[payment_gross] => 1.37
				[payment_status] => Completed
				[payment_type] => instant
				[protection_eligibility] => Ineligible
				[quantity] => 1
				[receiver_email] => athan17@gmail.com
				[receiver_id] => CKQMJ4V2CSMFG
				[residence_country] => US
				[shipping] => 0.00
				[tax] => 0.00
				[transaction_subject] => 
				[txn_id] => 905763877K570433Y
				[txn_type] => web_accept
			)
			*/
			$api_billing = json_decode($response['custom']);
			// var_dump($notpaid_months);
			// $today =  date('Y-m-d', strtotime($response['payment_date']));
			$amount_paid = $response['payment_gross'];
			// $query = $this->database_model->read_user_information($this->session->userdata('email'));
			// $apikey = $query[0]->apikey;
			// print_r($api_billing);
			// exit();
			$this->database_model->paid_complete($api_billing,$amount_paid);
			redirect(base_url().'billing','refresh');
		}
		else
		{
			// Log the error, ignore it, whatever 
		}
	}
	
	// public function billing_complete_new()
	// {
		// $ipn_post_data = $_POST;
	// }
	// public function testingtesting()
	// {
		// $display['today'] = $today = date('Y-m-01');
		
		// $start_date = date('2015-05-01');
		// $display['start_date'] = $start_date;
		// $var_date = date('Y-m-01',(strtotime($start_date)));
		// while($today > $var_date)
		// {
			// $display[] = $var_date;
			// $display[] = date('Y-m-d',(strtotime ( 'last day of this month' , strtotime ( $var_date) ) ));
			// $var_date = date('Y-m-d',(strtotime ( '+1 month' , strtotime ( $var_date) ) ));
		// }
		
		// echo "<pre>";
		// print_r($display);
	// }
	
	public function documentation()
	{
		$this->not_confirmed();
		$this->_render('user/apidocu');
	}
	
	public function contact()
	{
		$this->_render('user/contact');
	} 
	
	public function accountsettings()
	{
		$this->css[] = base_url() . "resources/vendor/csspinner/csspinner.min.css";
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		$user_info = $query[0];
		// if($user_info->link != 'vocabdb')
		// {
			$data['user_info'] = $user_info;
		// }
		
		$this->_render('user/accountsettings',$data);
	}
	
	public function upload_pic()
	{
		// print_r( $_FILES );
		$config['upload_path']          = './resources/images/user_pics/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 300;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;

        $this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile'))
        {
            // $data = array('error' => $this->upload->display_errors());
			$return['status'] = FALSE;
        }
        else
        {
            // $data = array('upload_data' => $this->upload->data());
			$return['status'] = TRUE;
			$return['img_link'] = base_url()."resources/images/user_pics/".$this->upload->data('file_name');
			$return['img_path'] = $this->upload->data('full_path');
        }

		echo json_encode( $return );
		// echo json_encode( $this->upload->data() );
	}
	public function pic_save()
	{
		$this->load->helper("file");
		
		$pic = $this->input->post('pic');
		$all_pics = json_decode( $this->input->post('all_pics') );
		
		$this->session->userdata('pic');
		
		$link = explode("/",$this->session->userdata('pic'));
		$string = read_file('./resources/images/user_pics/'. end($link) );
		if($string)
		{
			@unlink( './resources/images/user_pics/'. end($link) );
		}
		
		foreach($all_pics as $k=>$v)
		{
			if( $pic == $k )
			{
				$this->database_model->save_pic_link( $this->session->userdata('email'), $v );
				$this->session->set_userdata('pic', $v);
			}
			else
			{
				unlink($k);
			}
		}
		echo $this->session->userdata('pic');
	}
	
	public function pic_delete()
	{
		$all_pics = json_decode( $this->input->post('all_pics') );
		foreach($all_pics as $k=>$v)
		{
			unlink($k);
		}
	}
	
	public function account_save()
	{
		$val = $this->input->post('val');
		$target = $this->input->post('target');
		$this->database_model->accountsettings_edit_info( $this->session->userdata('email'), $val, $target );
		if( $target == 'last_name' )
		{
			$this->session->set_userdata('name', $val);
			echo TRUE;
		}
		else
		{
			echo FALSE;
		}
	}
	
	public function send_message()
	{
		$email = $this->session->userdata('email');
		$data['email'] = $email;
		$data['msg'] = $this->input->post('content');
		$data['link'] = base_url();
		$data['subject'] = $subj = $this->input->post('subject');
		
		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'vocadb.api@gmail.com',
			'smtp_pass' => '$api$vocadb',
			'mailtype'  => 'html', 
			'charset'   => 'iso-8859-1'
		);
		$this->load->library('email',$config);	
		
		$this->email->set_newline("\r\n");
		$this->email->clear();
		
		$sentto[] = $email;
		$sentto[] = 'vocadb.api@gmail.com';
		$this->email->to($sentto);
		$this->email->subject( "Message from VocabDB API, Subject:".$subj );
		$this->email->message($this->load->view("user/send_email",$data,true));
		$this->email->send();
	}
	
	public function send_message_2()
	{
		$email = $this->session->userdata('email');
		$data['email'] = $email;
		$data['msg'] = $this->input->post('content');
		$data['link'] = base_url();
		$data['subject'] = $subj = $this->input->post('subject');

		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);	
		
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('vocadb.api@gmail.com');
		
		$sentto[] = $email;
		$sentto[] = 'vocadb.api@gmail.com';
		$this->email->to($sentto);

		$this->email->subject( "Message from VocabDB API, Subject:".$subj );
		$this->email->message($this->load->view("user/send_email",$data,true));
		if (!$this->email->send()) echo FALSE;
	}
	
	public function account_change_email()
	{
		$val = $this->input->post('val');
		$this->database_model->accountsettings_change_email( $this->session->userdata('email'), $val );
		$this->session->set_userdata('email', $val);
		$this->session->set_userdata('confirm', 0);
		
		$password = $this->database_model->get_password($val);
		$this->send_confirm_email($val,$password);
		// echo $this->session->userdata('email')." ".$val." 12345 ".$password;
		// echo "return this msg";
	}

	private function send_confirm_email($email,$password)
	{
		$data['link'] = base_url()."login/verify?email=".$email."&verify_key=".md5($email.$password);

		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('vocadb.api@gmail.com');
		$sentto[] = $email;
		$this->email->to($sentto);
		$this->email->subject('Email Confirmation');
		$this->email->message($this->load->view("login/send_confirm",$data,true));
		$this->email->send();
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
			$this->account_changepass_email( $this->session->userdata('email'),$new_pass );
			echo true;
		}
		else
		{
			echo false;
		}
		
	}
	
	private function account_changepass_email($email,$password)
	{
		$data['email'] = $email;
		$data['password'] = $password;
		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('vocadb.api@gmail.com');
		$sentto[] = $email;
		$this->email->to($sentto);
		$this->email->subject('Change Password');
		$this->email->message($this->load->view("user/change_pass",$data,true));
		$this->email->send();
	}
}
?>