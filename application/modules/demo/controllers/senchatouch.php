<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class senchatouch extends MY_Controller {
	public function __construct() {
		parent::__construct();
    }
    public function demo1(){
        $data['title']      = "Chương trình sencha extjs đầu tiên"; 
        $this->load->view("senchatouch/demo1/home");
    }
    public function demo4(){
        $data['title']      = "Chương trình sencha extjs đầu tiên"; 
        $this->load->view("senchatouch/demo1/full");
    }
}