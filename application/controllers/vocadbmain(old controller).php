<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vocadbmain extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('database_model');
		$this->mynav = FALSE; //true=implement side-nav to all pages
		$this->css[] = "resources/app/css/bootstrap.css";
		$this->css[] = "resources/app/css/app.css";
		$this->css[] = "resources/vendor/fontawesome/css/font-awesome.min.css";
		// $this->css[] = "resources/vendor/animo/animate+animo.css";
		// $this->css[] = "resources/vendor/csspinner/csspinner.min.css";
		// $this->js[] = "resources/vendor/modernizr/modernizr.js";
		// $this->js[] = "resources/vendor/fastclick/fastclick.js";
    }
	
	
	public function index()
	{
        $this->_render("login_form");
	}
	public function register(){
		$fb = array();
		if( $this->session->has_userdata('email') )
		{
			$fb['fb_email'] = "readonly='readonly' value='".$this->session->userdata('email')."'";
			$fb['fb_confirm'] = 1;
			$fb['cancel_pass'] = 1;
		}
		else
		{
			$fb['fb_email'] = "";
			$fb['fb_confirm'] = 0;
		}
		if( $this->session->has_userdata('name') )
		{
			$fb['fb_name'] = "readonly='readonly' value='".$this->session->userdata('name')."'";
			$fb['fb_link'] = "facebook";
		}
		$this->session->sess_destroy();
		$this->_render("registration_form", $fb);
	}
	
	public function home()
	{
		$this->_render('home');
		$this->is_logged_in();
	}
	
	public function login_process(){
		$return = array();
		
		$extracheck = $this->input->post('fromfb');
		$data = array(
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password')
		);
		$result = $this->database_model->login($data);
		if($result || $extracheck){
			$email = $this->input->post('email');
			$result = $this->database_model->read_user_information($email);
			$confirm = $this->database_model->check_confirmation_email($email);
			if($result)
			{
				$session_data = array(
				'email' => $this->input->post('email'),
				'name' => $result[0]->last_name,
				'pic' => $this->input->post('pic')
				);
				$this->session->set_userdata($session_data);
				
				if($confirm)
				{
					$return['link'] = base_url()."feat";
					$return['msg'] = "Logging in..";
				}
				else
				{
					$return['link'] = base_url()."confirm";
					$return['msg'] = "Please verify your email address";
				}
			}
			else
			{
				$session_data = array(
				'email' => $this->input->post('email'),
				'name' => $this->input->post('name'),
				'pic' => $this->input->post('pic')
				);
				$this->session->set_userdata($session_data);
				
				$return['link'] = base_url()."register";
				$return['msg'] = "Account not yet registered.";
			}
			$return['state'] = TRUE;
		}
		else{
			// $data = array('error_message'=>'Invalid Username or Password');
			// $this->_render('login_form',$data);
			$return['state'] = FALSE;
			$return['link'] = "";
			$return['msg'] = "Check email/password";
		}
		echo json_encode($return);
	}
	
	public function new_user_registration(){
		$data = array(
			'apikey' => $this->gen_api_key(),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'last_name' => $this->input->post('name'),
			'start_date' => date("Y-m-d H:i:s"),
			'company' => $this->input->post('company'),
			'platform' =>  $this->input->post('platform'),
			'how' => $this->input->post('how'),
			'nationality' => $this->input->post('vocadb_lang'),
			'confirm' => $this->input->post('confirm'),
			'link' => $this->input->post('link')
			
		);
		$result = $this->database_model->registration_insert($data);
		if($result===true){
			// $this->_render('login_form');
			if($this->input->post('confirm') )
			{
				$this->send_confirm_email( $this->input->post('email'), $this->input->post('password') );
			}
			echo $result;
		}
		else
		{
			echo FALSE;
			// $data['dbError'] = $result;
			// $this->_render('register',$data);
		}
	}
	
	public function send_confirm_email($email,$password)
	{
		$data['link'] = base_url()."verify?email=".$email."&verify_key=".md5($email.$password);
		
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
		// echo "<pre>";
		// print_r($data);
	}
	
	public function resend_confirm()
	{
		$email = $this->input->post('email');
		$password = $this->database_model->get_password($email);

		$data['link'] = base_url()."verify?email=".$email."&verify_key=".md5($email.$password);
		
		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);	
		
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('vocabdb.api@gmail.com');
		$sentto[] = $email;
		$this->email->to($sentto);
		$this->email->subject('Email Confirmation');
		$this->email->message($this->load->view("mail_structure",$data,true));
		$this->email->send();

	}
	
	public function verify()
	{
		$email = $this->input->get("email");
		$verify_key = $this->input->get("verify_key");
		// echo $verify_key;
		$verify = $this->database_model->verifier($email,$verify_key);
		if($verify)
		{
			$this->database_model->confirmed($email);
			echo "Thank you for your confirmation.";
		}
		else
		{
			echo "Error with confirmation. Please try again.";
		}
	}
	
	public function confirm()
	{
		$data['email'] = $this->session->userdata('email');
		$this->load->view("confirm_require",$data);
		$this->is_logged_in();
	}
	
	//check if logged in
	public function is_logged_in()
	{
		$email = $this->session->userdata('email');
		if( $this->database_model->check_confirmation_email($email) )
		{
			redirect(base_url().'feat', 'refresh');
		}
	}
	
	/*
		User management After Log IN
	*/
	
	//redirect if not logged in
	public function not_logged_in()
	{
		if( !$this->session->userdata('email') )
		{
			redirect(base_url(), 'refresh');
		}
	}
	
	public function logout() 
	{
		$this->session->sess_destroy();
		redirect(base_url(), 'refresh');
	}
	
	public function feat()
	{
		$this->not_logged_in();
		$this->mynav = TRUE;
		$this->_render('feat');
	}
	
	public function stats(){
		$this->mynav = TRUE;
		$adminchecker = TRUE;
		// if( $adminchecker )
		// {
			// $data['text_result'] = $this->database_model->get_usage_admin(1);
		// }
		// else
		// {
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		// echo $query[0]->apikey;
		// var_dump($query);
		// exit();
		$data['text_result'] = $this->database_model->get_usage_users(1,$query[0]->apikey);

	    
		$this->_render('stats',$data);
	}
	
	public function monthstats_users()
	{
		$num = $this->input->post('num');
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		echo json_encode($this->database_model->get_usage_users($num,$query[0]->apikey));
	}
	
	public function monthstats()
	{
		$num = $this->input->post('num');
		// echo $num;
		echo json_encode($this->database_model->get_usage_admin($num));
	}

	public function billing()
	{
		$this->not_logged_in();
		$this->mynav = TRUE;
		$this->_render('billing');
	}
	
	public function documentation()
	{
		$this->not_logged_in();
		$this->mynav = TRUE;
		$this->_render('docu');
	}
	
	public function contact()
	{
		$this->not_logged_in();
		$this->mynav = TRUE;
		$this->_render('contact');
	}
	
	public function accountsettings()
	{
		$this->not_logged_in();
		$this->mynav = TRUE;
		$this->_render('accountsettings');
	}
	
	public function test()
	{
		// $date = date('Y-m-d H:i:s', strtotime('2015-03-28 00:00:00'));
		// $date = strtotime('2015-03-31 05:47:19');
		// echo $date."<br/>";
		// echo date('Y-m-d H:i:s',(strtotime ( '-1 month' , strtotime ( $date) ) ));
		echo "random pass generator:";
		
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		 for ($i = 0; $i < 8; $i++) {
			  $string .= $characters[rand(0, strlen($characters) - 1)];
		 }
		 echo "<br/>".$string;
	}
	/*
		API key generator
	*/
	private function gen_api_key()
	{
		$key=date("Y/m/d")."vocaDB".date("h:i:sa");
		$time = microtime(); 
		$time = explode( " " , $time ); 
		$time = $time[0] + $time[1]; 
		$key = md5($time.$key);// 32 character hex number , // md5(string,raw) 
		// echo $key."<br>";
		return $key;
	}
	/*
		Random Password generator
	*/
	private function gen_random_password()
	{
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		for ($i = 0; $i < 8; $i++) 
		{
			$string .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $string;
	}
}
?>