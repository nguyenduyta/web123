<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class link extends CI_Controller {
	public function __construct() {
         session_start();  
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('link_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->link_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'link_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách liên kết';
        $data['link']  = $this->link_model->fetchAll();
        $data['template'] = 'link/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'link_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm mới liên kết';
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("name","Tiêu đề liên kết","trim|required|callback_check_name|xss_clean");
                $this->form_validation->set_rules("link","Link liên kết","trim|required|min_length[4]|max_length[255]|xss_clean");
    			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tiêu đề liên kết đã tồn tại. Hãy chọn tiêu đề khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    			//Kiem tra
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'link/add';
    				$this->load->view("layout",$data);	
    			}else{
    			    $this->load->library('string');
    				$dataAdd = array(
    					'name'         =>  $this->input->post('name'),
    					'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'order'        =>  $this->input->post('order'),
                        'link'         =>  $this->input->post('link'),
                        'active'       =>  $this->input->post('active'),
                        'date'         =>  mktime()
    				);
    				
    				$this->link_model->add($dataAdd);
    				redirect(base_url('admin/link'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "link/add";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'link_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Sửa liên kết';
        $data['link'] = $this->link_model->fetchOne($segment4);
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("name","Tiêu đề liên kết","trim|required|callback_check_name|xss_clean");
                $this->form_validation->set_rules("link","Link liên kết","trim|required|min_length[4]|max_length[255]|xss_clean");
    			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tiêu đề liên kết đã tồn tại. Hãy chọn tiêu đề khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    			//Kiem tra
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'link/edit';
    				$this->load->view("layout",$data);	
    			}else{
    			    $this->load->library('string');
    				$dataEdit = array(
    					'name'         =>  $this->input->post('name'),
    					'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'order'        =>  $this->input->post('order'),
                        'link'         =>  $this->input->post('link'),
                        'active'       =>  $this->input->post('active'),
                        'date'         =>  mktime()
    				);
    				
    				$this->link_model->update($segment4, $dataEdit);
    				redirect(base_url('admin/link'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "link/edit";
    			$this->load->view("layout",$data);	 
    		}
    }

    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'link_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->link_model->delete($id);
        redirect(base_url('admin/link'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_link 
                INNER JOIN tbl_user
                ON tbl_link.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY tbl_link.id ASC";
        $result = $this->link_model->query($sql);
        $data['link'] = $result;
        $data['template'] = "link/search";
		$this->load->view("layout",$data);	 
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
				$this->link_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->link_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/link'), 'location');
		}
    }
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->link_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

