<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class index extends MY_Controller {
	public function __construct() {
		parent::__construct();
    }
    public function nguyenminhthuan(){
        $this->load->view("nguyenminhthuan");
    }
    public function nguyenvantrong(){
        $this->load->view("nguyenvantrong");
    }
    
}