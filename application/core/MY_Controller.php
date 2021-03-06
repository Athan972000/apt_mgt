<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $title = "VocaDB";
    protected $data = array();
	protected $css = array();
    protected $js = array();

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function _render($view, $add_val=NULL) {
        $data = $this->data;
		$data['Nvoca'] = $add_val;
		
		$data['css'] = $this->css;
        $data['js'] = $this->js;
        
        $data['title'] = $this->title;
		$data['mynav'] = $this->mynav;
        $data['head'] = $this->load->view('templates/head', $data, true);
        $data['nav'] = $this->load->view($this->viewnav, $data, true);
        $data['header'] = $this->load->view('templates/header', $data, true);
		$data['footer'] = $this->load->view('templates/footer',$data, true);
		$data['scripts'] = $this->load->view('templates/scripts', $data, true);
        $data['content'] = $this->load->view($view, $data, true);

        $this->load->view('templates/skeleton', $data);
    }
}
?>