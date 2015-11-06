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
		$this->_render('user/feat');
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
	
	public function stats(){
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		$data['text_result'] = $this->database_model->get_usage_users(1,$query[0]->apikey);
		$this->_render('user/stats',$data);
	}
	
	public function monthstats_users()
	{
		$num = $this->input->post('num');
		$query = $this->database_model->read_user_information($this->session->userdata('email'));
		echo json_encode($this->database_model->get_usage_users($num,$query[0]->apikey));
	}

	public function billing()
	{
		$this->_render('user/billing');
	}
	
	public function documentation()
	{
		// $this->css[] = "https://cloud.google.com/_static/2ec7578929/css/screen-maia.css";
		// $this->css[] = "http://www.google.com/css/maia.experimental.css";
		// $this->css[] = "https://cloud.google.com/_static/2ec7578929/css/maia-cloud.css";
		// $this->css[] = "http://www.vocadb.co.kr/dic/js/vocat.css";
		$this->_render('user/apidocu');
	}
	
	public function apidocu()
	{
		$this->load->view('user/apidocu');
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
		if($user_info->link != 'vocabdb')
		{
			$data['user_info'] = $user_info;
		}
		
		$this->_render('user/accountsettings',$data);
	}
	
	public function upload_pic()
	{
		// print_r( $_FILES );
		$config['upload_path']          = './resources/images/user_pics/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
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

		$data['msg'] = $this->input->post('content');
		$data['link'] = base_url().'contact';
		
		$config['mailtype'] = 'html';
		$config['charset']  = 'UTF-8';
		$this->load->library('email',$config);	
		
		$this->email->set_newline("\r\n");
		$this->email->clear();
		$this->email->from($email);
		$sentto[] = $email;
		$sentto[] = 'vocabdb.api@gmail.com';
		$this->email->to($sentto);
		$this->email->subject($this->input->post('subject'));
		$this->email->message($this->load->view("user/send_email",$data,true));
		$this->email->send();
	}
}
?>