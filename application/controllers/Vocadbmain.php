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
	
	public function register($email=NULL,$name=NULL){
		$fb = array();
		
		if( isset($email) )
		{
			$fb['fb_email'] = "readonly='readonly' value='".$email."'";
		}
		if( isset($name) )
		{
			$fb['fb_name'] = "readonly='readonly' value='".$name."'";
		}
		$this->_render("registration_form", $fb);
	}
	
	public function check_user()
	{
		$email = $this->input->get("email");
		$name = $this->input->get("name");
		$check = $this->database_model->read_user_information($email);
		$confirm = $this->database_model->check_confirmation_email($email);
		if( $check && $confirm )
		{
			redirect(base_url().'/welcome', 'refresh');
		}
		else if ( $confirm )
		{
			//land on email confirmation
			redirect(base_url().'/conrfirm', 'refresh');
		}
		else
		{
			$this->register($email,$name);
		}
		
	}
	
	public function welcome(){
		$this->mynav=TRUE;
		$this->_render('welcome_message');
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
			'last_name' => $this->input->post('name'),
			'start_date' => date("Y-m-d H:i:s"),
			'company' => $this->input->post('company'),
			'platform' =>  $this->input->post('platform'),
			'how' => $this->input->post('how'),
			'nationality' => $this->input->post('nationality'),
			'confirm' => $this->input->post('confirm'),
			'link' => $this->input->post('link')
			
		);
		$result = $this->database_model->registration_insert($data);
		if($result===true){
			// $this->_render('login_form');
			$this->send_confirm_email($data['email'],$data['password']);
			echo $result;
		}
		else
		{
			echo $result;
			$data['dbError'] = $result;
			$this->_render('register',$data);
		}
	}
	
	public function send_confirm_email($email,$password)
	{
		$data['link'] = base_url()."verify?verify_key=".md5($email.$password);
		
		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);	
		
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('vocabdb.api@gmail.com');
		
		$sentto[] = $email;
		// $sentto[] = 'vocadb.api@gmail.com';
		$this->email->to($sentto);

		$this->email->subject('Email Confirmation');
		// $this->email->message($this->load->view("mail_structure",$data,true));
		$this->email->message($this->load->view("mail_structure",$data,true));
		$this->email->send();
		// if (!$this->email->send()) echo "Sorry to sending failure, Try it again";
	}
	
	public function verify()
	{
		$verify_key = $this->input->get("verify_key");
		echo $verify_key;
	}
	public function confirm()
	{
		//resend confirm
	}
}
?>