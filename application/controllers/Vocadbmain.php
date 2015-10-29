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
		$fb = array();
		if( $this->session->has_userdata('email') )
		{
			$fb['fb_email'] = "readonly='readonly' value='".$this->session->userdata('email')."'";
			$fb['fb_confirm'] = 1;
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
	
	public function check_user()
	{
		$email = $this->input->get("email");
		$name = $this->input->get("name");
		$check = $this->database_model->read_user_information($email);
		$confirm = $this->database_model->check_confirmation_email($email);
		// echo $confirm;exit();
		if( $check && $confirm )
		{
			redirect(base_url().'feat', 'refresh');
		}
		else if ( $check && !$confirm )
		{
			//land on email confirmation
			redirect(base_url().'confirm', 'refresh');
		}
		else
		{	
			$newdata = array(
				'name'  => $name,
				'email'     => $email
			);

			$this->session->set_userdata($newdata);
			redirect(base_url().'register', 'refresh');
			// $this->register($email,$name);
		}
	}
	
	public function home(){
		$this->_render('home');
	}
	
	public function login_process(){
		// $this->is_logged_in();
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
			$confirm = $this->database_model->check_confirmation_email($email);
			if($result){
				$session_data = array(
				'email' => $result[0]->email,
				'name' => $result[0]->last_name
				);
			}
			$this->session->set_userdata($session_data);
			
			if($confirm)
			{
				$return = "confirmed";
			}
			else
			{
				$return = "notconfirmed";
			}
			echo $return;
		}
		else{
			// $data = array('error_message'=>'Invalid Username or Password');
			// $this->_render('login_form',$data);
			echo FALSE;
		}
		
	}
	
	public function new_user_registration(){
		$data = array(
			'apikey' => rand(10000000000000000000000000000000, 99999999999999999999999999999999),
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
		$data['link'] = base_url()."verify?email=".$email."&verify_key=".$email.$password;
		
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
		if( $adminchecker )
		{
			$data['text_result'] = $this->database_model->get_usage_admin(1);
		}
		else
		{
			$query = $this->database_model->read_user_information($this->session->userdata('email'));
			$data['text_result'] = $this->database_model->get_usage_users($query[0]->apikey);
		}
	    
		$this->_render('stats',$data);
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
	
	public function insert()
	{
		$date = date('Y-m-d H:i:s', strtotime('2015-03-28 00:00:00'));
		// $date = strtotime('2015-03-31 05:47:19');
		echo $date."<br/>";
		echo date('Y-m-d H:i:s',(strtotime ( '-1 month' , strtotime ( $date) ) ));
		
		// for($x=1;$x<=65;$x++)
		// {
			// $thisdate = date('Y-m-d H:i:s',(strtotime ( '-'. $x .' day' , strtotime ( $date) ) ));
			// $data = array(
			// 'auto' => '',
			// 'apikey' => '3066',
			// 'word' => 'Hi',
			// 'datetime' => $thisdate,
			// 'length' => '2',
			// 'type' => '1'
			// );

			// $this->db->insert('api_usage_definition',$data);
		// }
	}
}
?>