<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class taigame extends MY_Controller{
	public function __construct() {
		parent::__construct();
    }
    public function index(){
        $data['title']      = "Trang mobile"; 
        $this->load->view("taigame/index");
    }
}