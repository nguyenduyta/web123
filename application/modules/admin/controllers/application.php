<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class application extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('application_model');
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'application_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Hồ sơ  tuyển dụng';
        $data['application'] = $this->application_model->fetchAll();
        $data['template'] = 'application/default';
        $this->load->view('layout', $data);
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'application_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->application_model->delete($id);
        redirect(base_url('admin/application'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_application 
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->application_model->query($sql);
        $data['application'] = $result;
        $data['template'] = "application/search";
		$this->load->view("layout",$data);	 
    }
}

