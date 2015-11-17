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
		// $this->css[] = "resources/vendor/csspinner/csspinner.min.css";
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
	
	public function income_stats()
	{
		$data['min_date'] = date('Y-m-d' ,strtotime('+1 day',strtotime($this->database_model->last_billed_date()) ));
		// $datetime = new DateTime('tomorrow');
		// $data['tomorrow'] = $datetime->format('F j, Y');
		$data['tomorrow'] = date('Y-m-d');
		$this->_render('admin/income_stats',$data);
	}
	
	public function billing_create()
	{
		$this->load->model('computation_model');
		$date1 = $this->input->post('date_from');
		$date2 = $this->input->post('date_to');
		if($date1 > $date2)
		{
			$temp = $date1;
			$date1 = $date2;
			$date2 = $temp;
		}
		$billing_info = $this->database_model->create_billing($date1,$date2);
		
		$billing_data = array();
		foreach($billing_info as $k=>$v)
		{
			$amount = $this->computation_model->compute_length($v['total']);
			$billing_data = array(
				'total' => $v['total'],
				'definition' => $v['definition'],
				'text' => $v['text'],
				'word' => $v['word'],
				'date_from' => $date1,
				'date_to' => $date2,
				'amount' => $amount,
				'apikey' => $k
			);
			$this->database_model->insert_billing($billing_data);
			//add email function here
		}
	}
}
?>