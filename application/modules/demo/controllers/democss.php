<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class democss extends MY_Controller {
	public function __construct() {
		parent::__construct();
    }
    public function menucapcap(){
        $data['title']      = "Menu đa cấp - menu da cap"; 
        $this->load->view("css/menudacap");
    }
}

