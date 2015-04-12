<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] != 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    public function index(){
        $data['title'] = 'test';
        $this->load->library('file');
        $folder = $this->file->load('application/modules/admin/controllers');
        print_r($folder);
    }
}

