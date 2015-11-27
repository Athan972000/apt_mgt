<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Callcenter extends MY_Controller {

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
		// $this->not_logged_in();
		$this->viewnav = "callcenter/nav";
    }
	
	public function not_logged_in()
	{
		if( !$this->session->userdata('email') )
		{
			redirect(base_url().'login', 'refresh');
		}
		else
		{
			$this->not_callcenter();
		}
		
	}
	
	private function not_callcenter()
	{
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		$user_type = $query[0]->user_type;
		if($user_type != 'callcenter')
		{
			redirect(base_url().'login', 'refresh');
		}
	}
	
	public function index()
	{
		// $data['text_result'] = $this->database_model->get_usage_admin(1);
		$data['user_list'] = $this->database_model->get_user_list();
		$this->_render('callcenter/users',$data);
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect(base_url().'login', 'refresh');
	}
	
	public function users()
	{
		$data['user_list'] = $this->database_model->get_user_list();
		$this->_render('callcenter/users',$data);
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

		$this->_render('callcenter/stats',$data);
	}

	public function settings()
	{
		$this->_render('callcenter/adminsettings');
	}
	
	// public function monthstats()
	// {
		// $num = $this->input->post('num');
		// echo json_encode($this->database_model->get_usage_admin($num));
	// }
	
	public function income_stats()
	{
		$data['min_date'] = date('Y-m-d' ,strtotime('+1 day',strtotime($this->database_model->last_billed_date()) ));
		// $datetime = new DateTime('tomorrow');
		// $data['tomorrow'] = $datetime->format('F j, Y');
		$data['tomorrow'] = date('Y-m-d');
		$this->_render('callcenter/income_stats',$data);
	}
	
}
?>