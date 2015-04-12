<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cart extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model("cart_model");
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->cart_model->delete($idGroup, 'cart_id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index() {
        $data['cartinfo'] = $this->cart_model->list_cart();
        $data['title'] = 'Danh sách đơn hàng';
        $data['template'] = 'cart/default';
        $this->load->view('layout', $data);
    }
    public function detail(){
        $id = $this->uri->segment(4);
        $data['info'] = $this->cart_model->detail($id);
        $data['title'] = 'Chi tiết đơn hàng';
        $data['template'] = 'cart/detail';
        $this->load->view('layout', $data);
    }

    public function delete() {
        $id = $this->uri->segment(4);        
        $this->cart_model->delete($id);
        redirect(base_url('admin/cart'), 'refresh');    
    }
    
    public function search() {
        
    }
}