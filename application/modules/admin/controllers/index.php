<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class index extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    public function index(){
        $data['title'] = 'Giới thiệu công ty NGC';
        $data['template'] = 'home/default';
        $this->load->view('layout', $data);
    }
}

