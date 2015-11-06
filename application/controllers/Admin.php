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
	}
	
	public function index()
	{
        // redirect(base_url(), 'refresh');
		$this->_render('admin/feat');
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect(base_url().'login', 'refresh');
	}
	
	public function feat()
	{
		redirect(base_url()."admin");
	}
	
	public function stats(){

		$data['text_result'] = $this->database_model->get_usage_admin(1);

		$this->_render('admin/stats',$data);
	}

	public function adminsettings()
	{
		$this->_render('admin/adminsettings');
	}
	
	public function income_stats()
	{
		$this->_render('admin/income_stats');
	}
	
	public function monthstats()
	{
		$num = $this->input->post('num');
		echo json_encode($this->database_model->get_usage_admin($num));
	}
}
?>