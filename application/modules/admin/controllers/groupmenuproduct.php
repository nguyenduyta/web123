<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class groupmenuproduct extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("group_menuproduct_model");
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->group_menuproduct_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'groupmenuproduct_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['groupmenuproduct'] = $this->group_menuproduct_model->list_group();
        $data['title'] = "Quản lý nhóm danh mục sản phẩm";
        $data['template'] ="groupmenuprduct/default";
        $this->load->view("layout",$data);
    }
    public function add(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'groupmenuproduct_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title']  = 'Thêm  nhóm danh mục sản phẩm';
        $data['template'] = 'groupmenuprduct/add';
        if(isset($_POST['isSubmit'])){
            $this->form_validation->set_rules("name","Tên nhóm danh mục sản phẩm","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên nhóm danh mục đã tồn tại. Hãy chọn tên danh mục khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
				$this->load->view("layout",$data);	
			}else{
                if($this->input->post('active') == 1) {
                    $active = 1;
                } else {
                    $active = 0;
                }
			    $data_insert = array(
                    'name'   =>  $this->input->post('name'),
                    'active' =>  $active
                ); 
                $this->group_menuproduct_model->add($data_insert);
                redirect(base_url().'admin/groupmenuproduct');
			}
            
        }else{
            $this->load->view('layout',$data);   
        }
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'groupmenuproduct_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->group_menuproduct_model->delete($id);
        redirect(base_url('admin/groupmenuproduct'), 'refresh');    
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
				$this->group_menuproduct_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->group_menuproduct_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/groupmenuproduct'), 'location');
		}
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_groupmenu_product
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY tbl_groupmenu_product.id ASC";
        $result = $this->group_menuproduct_model->query($sql);
        $data['groupmenuproduct'] = $result;
        $data['template'] = "groupmenuprduct/search";
		$this->load->view("layout",$data);	 
    }
    
    public function check_name(){
        $name = $_POST['name'];
        $check = $this->group_menuproduct_model->checkname($name);
        if($check > 0){
            return false;
        }else{
            return true;
        }
    }
}