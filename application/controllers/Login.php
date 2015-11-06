<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('database_model');
		$this->mynav = FALSE; //true=implement side-nav to all pages
		$this->css[] = base_url() . "resources/app/css/bootstrap.css";
		$this->css[] = base_url() . "resources/app/css/app.css";
		// $this->css[] = "resources/vendor/fontawesome/css/font-awesome.min.css";
		// $this->css[] = "resources/vendor/animo/animate+animo.css";
		// $this->css[] = "resources/vendor/csspinner/csspinner.min.css";
		// $this->js[] = "resources/vendor/modernizr/modernizr.js";
		// $this->js[] = "resources/vendor/fastclick/fastclick.js";
		$this->viewnav = "user/nav";
    }
	
	
	public function index()
	{
		// var_dump($this->session->userdata() );
		$this->is_logged_in();
        $this->_render("login/login_form");
	}
	public function register()
	{
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
		if( $this->session->has_userdata('pic') )
		{
			$fb['fb_pic'] = $this->session->userdata('pic');
		}
		else
		{
			$fb['fb_pic'] = null;
		}
		$this->session->sess_destroy();
		$this->_render("login/registration_form", $fb);
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
				
				if( $result[0]->user_type == 'admin' )
				{
					$session_data = array(
					'email' => $result[0]->email,
					'pic' => $result[0]->photo_link
					);
					$this->session->set_userdata($session_data);
					$return['link'] = base_url()."admin/feat";
					$return['msg'] = "Logging in as administrator";
				}
				else if($confirm)
				{
					$session_data = array(
					'email' => $result[0]->email,
					'pic' => $result[0]->photo_link
					);
					$this->session->set_userdata($session_data);
					$return['link'] = base_url()."feat";
					$return['msg'] = "Logging in..";
				}
				else
				{
					$return['link'] = base_url()."login/confirm";
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
				
				$return['link'] = base_url()."login/register";
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
			'link' => $this->input->post('link'),
			'photo_link' => $this->input->post('pic'),
			'user_type' => 'user'
			
		);
		$result = $this->database_model->registration_insert($data);
		if($result===true){
			// $this->_render('login_form');
			if($this->input->post('confirm') )
			{
				$this->send_confirm_email( $this->input->post('email'), $this->input->post('password') );
			}
			echo TRUE;
		}
		else
		{
			echo FALSE;
			// $data['dbError'] = $result;
			// $this->_render('register',$data);
		}
	}
	
	/*
		Send Email
	*/
	public function send_confirm_email($email,$password)
	{
		$data['link'] = base_url()."login/verify?email=".$email."&verify_key=".md5($email.$password);
		
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
		$this->email->message($this->load->view("login/send_confirm",$data,true));
		$this->email->send();
		// if (!$this->email->send()) echo "Sorry to sending failure, Try it again";
		// echo "<pre>";
		// print_r($data);
	}
	public function resend_confirm()
	{
		$email = $this->input->post('email');
		$password = $this->database_model->get_password($email);

		$data['link'] = base_url()."login/verify?email=".$email."&verify_key=".md5($email.$password);
		
		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);	
		
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from('vocabdb.api@gmail.com');
		$sentto[] = $email;
		$this->email->to($sentto);
		$this->email->subject('Email Confirmation');
		$this->email->message($this->load->view("login/send_confirm",$data,true));
		$this->email->send();
	}
	//send email when forgot_password
	public function forgotpass()
	{
		$data['email'] = $email = $this->input->post('email');
		$checkuser = $this->database_model->read_user_information($email);
		// var_dump( $checkuser );
		if( $checkuser )
		{
			$data['pass'] = $password = $this->database_model->get_password($email);
			// $data['pass'] = $new_pass = gen_random_password();
			// $this->database_model->set_new_password($email,$new_pass);

			$config['mailtype'] = 'html';
			$config['charset']  = 'UTF-8';
			$this->load->library('email',$config);	
			
			$this->email->set_newline("\r\n");
			$this->email->clear();
			$this->email->from('vocabdb.api@gmail.com');
			$sentto[] = $email;
			$this->email->to($sentto);
			$this->email->subject('Your New Password');
			$this->email->message($this->load->view("login/send_password",$data,true));
			$this->email->send();
			echo TRUE;
		}
		else
		{
			echo FALSE;
		}
		
	}
	
	//verify page
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
	
	//confirm page
	public function confirm()
	{
		$data['email'] = $this->session->userdata('email');
		$this->load->view("login/confirm_require",$data);
		$this->is_logged_in();
	}
	
	/*
		Check if already logged in
	*/
	public function is_logged_in()
	{
		if( $this->session->has_userdata('email') )
		{
			$email = $this->session->userdata('email');
			if( $this->database_model->check_confirmation_email($email) )
			{
				redirect(base_url().'feat', 'refresh');
			}
			else
			{
				redirect(base_url().'login/confirm', 'refresh');
			}
		}
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