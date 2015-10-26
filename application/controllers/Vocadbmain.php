<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vocadbmain extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		
		$this->load->model('database_model');
		
		$this->mynav = FALSE; //true=implement side-nav to all pages
		$this->css[] = "resources/app/css/bootstrap.css";
		$this->css[] = "resources/app/css/app.css";
		$this->css[] = "resources/vendor/fontawesome/css/font-awesome.min.css";
		$this->css[] = "resources/vendor/animo/animate+animo.css";
		$this->css[] = "resources/vendor/csspinner/csspinner.min.css";
		$this->js[] = "resources/vendor/modernizr/modernizr.js";
		$this->js[] = "resources/vendor/fastclick/fastclick.js";
    }
	
	public function index()
	{
        $this->_render("login_form");
	}
	
	public function register(){
		$this->_render("registration_form");
	}
	
	public function welcome(){
		$this->mynav=TRUE;
		$this->_render('welcome_message');
	}
	
	public function home(){
		$this->_render('home');
	}
	
	
	public function login_process(){
		
		// if(isset($this->session->userdata['logged_in'])){
			// $this->load->view('welcome');
		// }else{
			// $this->_render('login_form');
		// }
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		//check db to verify user login info
		$result = $this->database_model->login($data);
		if($result){
			$email = $this->input->post('email');
			$result = $this->database_model->read_user_information($email);
			if($result){
				$session_data = array(
				'email' => $result[0]->email,
				'first_name' => $result[0]->first_name
				);
			}
			
			//Add user data in session
			$this->session->set_userdata('logged_in',$session_data);

			// $this->load->view('welcome_message');
			echo TRUE;
		}
		else{
			// $data = array('error_message'=>'Invalid Username or Password');
			// $this->_render('login_form',$data);
			echo FALSE;
		}
		
	}
	
	public function logout() {

	// Removing session data
		$sess_array = array(
		'email' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Successfully Logout';
		$this->_render('login_form', $data);
	}
	
	
	public function new_user_registration(){
		$data = array(
			'apikey' => "",
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'last_name' => "",
			'start_date' => date("Y-m-d H:i:s"),
			'company' => "",
			'platform' => "android",
			'how' => "",
			'nationality' => "",
			'confirm' => "",
			'link' => ""
			
		);
		$result = $this->database_model->registration_insert($data);
		if($result===true){
			// $this->_render('login_form');
			echo $result;
		}
		else
		{
			echo $result;
			$data['dbError'] = $result;
			$this->_render('register',$data);
		}
	}
	
}
?>