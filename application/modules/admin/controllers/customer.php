<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class customer extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('customer_model');
        
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->customer_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'customer_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách khách hàng';
        $data['customer'] = $this->customer_model->fetchAll();
        $data['template'] = 'customer/default';
        $this->load->view('layout', $data);
    }
    
    public function active() {
  		//Change Status
  		$action = array('status', 'id');
		$getVar = $this->uri->uri_to_assoc(1, $action);
        $id = (int)$getVar['id'];
        $active = $getVar['status'];
		if($getVar['status'] != FALSE && trim($getVar['status']) != '' && $getVar['id'] != FALSE && (int)$getVar['id'] > 0)
		{
			switch(strtolower($getVar['status']))
			{
				case 'active':
                $data = array('active'=>1);
				$this->customer_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->customer_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/customer'), 'location');
		}
    }
    
    public function delete() {
        $id = $this->uri->segment(4);        
        $this->customer_model->delete($id);
        redirect(base_url('admin/customer'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_user 
                WHERE user_name 
                LIKE '%".$keyword."%'
                AND user_level = 4
                ORDER BY user_id ASC";
        $result = $this->customer_model->query($sql);
        $data['customer'] = $result;
        $data['template'] = "customer/search";
		$this->load->view("layout",$data);	 
    }
}   

