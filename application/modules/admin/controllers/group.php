<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class group extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('group_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->group_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'group_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách nhóm thành viên';
        $data['group'] = $this->group_model->fetchAll();
        $data['template'] = 'group/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'group_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm nhóm thành viên';
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("name","Tên nhóm","trim|required|callback_check_name|xss_clean");
    			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tên nhóm đã tồn tại. Hãy chọn tên nhóm khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    			//Kiem tra
    			if($this->form_validation->run()==FALSE){
    				if(is_array($this->input->post('permission'))) {
                        $data['permission'] = implode(',', $this->input->post('permission'));
    				}
    				else {
                        $data['permission'] = '';
    				}
                    $data['template'] = 'group/add';
    				$this->load->view("layout",$data);	
    			}else{
       				if(is_array($this->input->post('permission'))) {
                        $permission = implode(',', $this->input->post('permission'));
    				}
    				else {
                        $permission = 'none';
    				}
    				$dataAdd = array(
    					'name'         =>  $this->input->post('name'),
                        'order'        =>  $this->input->post('order'),
    					'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'permission'   =>  trim($permission),
                        'active'       =>  $this->input->post('active'),
                        'date'         =>  mktime()
    				);
    				
    				$this->group_model->add($dataAdd);
    				redirect(base_url('admin/group'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "group/add";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'group_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $segment4 = (int)$this->uri->segment(4);
        $data['group'] = $this->group_model->fetchOne($segment4);
        $data['title'] = 'Sửa nhóm thành viên';
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("name","Tên nhóm","trim|required|callback_check_name|xss_clean");
    			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tên nhóm đã tồn tại. Hãy chọn tên nhóm khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    			//Kiem tra
    			if($this->form_validation->run()==FALSE){
    				if(is_array($this->input->post('permission'))) {
                        $data['permission'] = implode(',', $this->input->post('permission'));
    				}
    				else {
                        $data['permission'] = '';
    				}
    				$data['template'] = 'group/edit';
    				$this->load->view("layout",$data);	
    			}else{
       				if(is_array($this->input->post('permission'))) {
                        $permission = implode(',', $this->input->post('permission'));
    				}
    				else {
                        $permission = 'none';
    				}
    				$dataEdit = array(
    					'name'         =>  $this->input->post('name'),
                        'order'        =>  $this->input->post('order'),
    					'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'permission'   =>  trim($permission),
                        'active'       =>  $this->input->post('active'),
                        'date'         =>  mktime()
    				);
    				
    				$this->group_model->edit($segment4, $dataEdit);
    				redirect(base_url('admin/group'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "group/edit";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'group_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->group_model->delete($id);
        redirect(base_url('admin/group'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_group
                INNER JOIN tbl_user
                ON tbl_group.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->group_model->query($sql);
        $data['group'] = $result;
        $data['template'] = "group/search";
		$this->load->view("layout",$data);	 
    }
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->group_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

