<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class analytic extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('product_model');
         $this->load->model('news_model');
         $this->load->model('menuproduct_model');
         $this->load->model('menunews_model');
         $this->load->model('post_model');
         $this->load->model('customer_model');
    }
    
    public function index() {
        $data['title'] = 'Thống kê website';
        $data['product'] = $this->product_model->total();
        $data['news'] = $this->news_model->total();
        $data['menuproduct'] = $this->menuproduct_model->total();
        $data['menunews'] = $this->menunews_model->total();
        $data['post'] = $this->post_model->total();
        $data['customer'] = $this->customer_model->total();
        $data['template'] = 'analytic/default';
        $this->load->view('layout', $data);
    }
}

