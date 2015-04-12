<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class extjshello extends MY_Controller {
	public function __construct() {
		parent::__construct();
    }
    public function index(){
        $data['title']      = "Chương trình sencha extjs đầu tiên"; 
        $this->load->view("extjshello/index");
    }
}

