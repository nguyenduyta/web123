<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class contact extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('contact_model');
    }
    public function index(){
        $data['title'] = 'Danh sách khách hàng liên hệ';
        $data['contact'] = $this->contact_model->fetchAll();
        $data['template'] = 'contact/default';
        $this->load->view('layout', $data);
    }
    
    public function delete() {
        $id = $this->uri->segment(4);        
        $this->contact_model->delete($id);
        redirect(base_url('admin/contact'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_contact 
                ORDER BY id ASC";
        $result = $this->contact_model->query($sql);
        $data['contact'] = $result;
        $data['template'] = "contact/search";
		$this->load->view("layout",$data);	 
    }
    
    public function detail() {
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Nội dung chi tiết liên hệ';
        $data['content'] = $this->contact_model->fetchOne($segment4);
        $data['template'] = "contact/detail";
		$this->load->view("layout",$data);	 
    }
}

