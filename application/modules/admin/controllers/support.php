<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class support extends CI_Controller{
	public function __construct() {
		parent::__construct();
        session_start();   
        $this->load->model('support_model');
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->support_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'support_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách hỗ trợ';
        $data['support'] = $this->support_model->fetchAll();
        $data['template'] = 'support/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'support_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm tài khoản hỗ trợ';
            if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("name","Tên tài khoản","trim|required|min_length[3]|max_length[255]|callback_check_name|xss_clean");
                $this->form_validation->set_rules("yahoo","Tài khoản yahoo","trim|required|min_length[3]|max_length[255]|xss_clean");
                $this->form_validation->set_rules("skype","Tài khoản skype","trim|min_length[3]|max_length[255]|xss_clean");
                $this->form_validation->set_rules("phone","Số điện thoại","trim|required|min_length[3]|max_length[255]|xss_clean");
                $this->form_validation->set_rules("facebook","Tài khoản facebook","trim|min_length[3]|max_length[255]|xss_clean");
                $this->form_validation->set_rules("order","Thứ tự","trim|numeric|min_length[1]|max_length[11]|xss_clean");

                
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tài khoản này đã tồn tại. Hãy chọn tài khoản khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'support/add';
    				$this->load->view("layout",$data);	
    			}else{
    				$dataAdd = array(
                        'name'         =>  $this->input->post('name'),
                        'yahoo'        =>  $this->input->post('yahoo'),
    					'skype'        =>  $this->input->post('skype'),
    					'facebook'     =>  $this->input->post('facebook'),
                        'phone'        =>  $this->input->post('phone'),
    					'order'        =>  $this->input->post('order'),
                        'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'date'         =>  mktime(),
                        'active'       =>  $this->input->post('active')
    				);
    
    				$this->support_model->add($dataAdd);
    				redirect(base_url('admin/support'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "support/add";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'support_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thay đổi thông tin tài khoản hỗ trợ';
        $segment4 = (int)$this->uri->segment(4);
        $data['support'] = $this->support_model->fetchOne($segment4);
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tên tài khoản","trim|required|min_length[3]|max_length[255]|callback_check_name|xss_clean");
            $this->form_validation->set_rules("yahoo","Tài khoản yahoo","trim|required|min_length[3]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("skype","Tài khoản skype","trim|min_length[3]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("phone","Số điện thoại","trim|required|min_length[3]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("facebook","Tài khoản facebook","trim|min_length[3]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự","trim|numeric|min_length[1]|max_length[11]|xss_clean");

            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tài khoản này đã tồn tại. Hãy chọn tài khoản khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'support/edit';
				$this->load->view("layout",$data);	
			}else{
				$dataEdit = array(
                    'name'         =>  $this->input->post('name'),
                    'yahoo'        =>  $this->input->post('yahoo'),
					'skype'        =>  $this->input->post('skype'),
					'facebook'     =>  $this->input->post('facebook'),
                    'phone'        =>  $this->input->post('phone'),
					'order'        =>  $this->input->post('order'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active')
				);

				$this->support_model->update($segment4, $dataEdit);
				redirect(base_url('admin/support'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "support/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'support_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->support_model->delete($id);
        redirect(base_url('admin/support'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_support 
                INNER JOIN tbl_user
                ON tbl_support.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->support_model->query($sql);
        $data['support'] = $result;
        $data['template'] = "support/search";
		$this->load->view("layout",$data);	 
    }
    
    public function sort() {
        
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
				$this->support_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->support_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/support'), 'location');
		}
    }
    
    
    public function check_name() {
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->support_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

