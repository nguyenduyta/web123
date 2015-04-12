<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class member extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('member_model');
         $this->load->model('group_model');
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'member_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách thành viên';
        $data['user'] = $this->member_model->fetchAll();
        $data['template'] = 'member/default';
        $this->load->view('layout', $data);
    }
    public function add() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'member_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $this->load->library('file');
        $this->load->model('permission_model');
        $data['permission'] = $this->permission_model->fetchAll();
        $data['title'] = 'Thêm thành viên';
        $data['group'] = $this->group_model->fetchAllGroup();
        $data['folder'] = $this->file->load('application/modules/admin/controllers');
            if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("user_name","Tên truy cập","trim|required|min_length[3]|max_length[50]|callback_check_name|xss_clean");
    			$this->form_validation->set_rules("password","Mật khẩu","trim|required|min_length[4]|max_length[50]|xss_clean");
                $this->form_validation->set_rules("repassword","Nhập lại mật khẩu","trim|required|matches[password]|xss_clean");
                $this->form_validation->set_rules("user_email","Email","trim|required|valid_email|max_length[100]|xss_clean");
                $this->form_validation->set_rules("repassword","Nhập lại mật khẩu","trim|required|matches[password]|xss_clean");
                $this->form_validation->set_rules("fullname","Tên đầy đủ","trim|required|max_length[200]|xss_clean");
                $this->form_validation->set_rules("user_phone","Điện thoại","trim|numeric|max_length[20]|xss_clean");
                $this->form_validation->set_rules("user_mobile","Di động","trim|numeric|max_length[20]|xss_clean");
                $this->form_validation->set_rules("user_yahoo","Tài khoản Yahoo","trim|max_length[50]|xss_clean");
                $this->form_validation->set_rules("user_skype","Tài khoản Skype","trim|max_length[50]|xss_clean");
                $this->form_validation->set_rules("user_facebook","Tài khoản Facebook","trim|max_length[50]|xss_clean");
                $this->form_validation->set_rules("user_order","Thứ tự xắp xếp","trim|numeric|max_length[11]|xss_clean");
                $this->form_validation->set_rules("user_level","Nhóm thành viên","trim|required|xss_clean");
                
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tên truy cập này đã tồn tại. Hãy chọn tên truy cập khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'member/add';
    				$this->load->view("layout",$data);	
    			}else{
                    $option  = array(
                        "ngaysinh"=>$_POST['user_day'],
                        "thangsinh"=>$_POST['user_month'],
                        "namsinh"=>$_POST['user_year'],
                        "sex"=>$_POST['user_sex'],
                        "address"=>$_POST['user_address'],
                        "phone"=>$_POST['user_phone'],
                        "mobile"=>$_POST['user_mobile'],
                        "yahoo"=>$_POST['user_yahoo'],
                        "skype"=>$_POST['user_skype'],
                        "facebook"=>$_POST['user_facebook']
                    );
                    $option_text = json_encode($option);
                    $data_user = array(
                        "user_name"=>$_POST['user_name'],
                        "fullname"=>$_POST['fullname'],
                        "password"=>md5($_POST['password']),
                        "user_email"=>$_POST['user_email'],
                        "user_level"=>$_POST['user_level'],
                        "user_active"=>$_POST['user_active'],
                        "created_by"=>$_SESSION['id'],
                        "modified_by"=>$_SESSION['id'],
                        "date"  =>time(),
                        "order"  =>$_POST['user_order'],
                        "active"  =>$_POST['user_active'],
                        "user_option"=>$option_text,
                        "avata"=>$_POST['user_avatar']
                    );
    
    				$this->member_model->add($data_user);
    				redirect(base_url('admin/member'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "member/add";
    			$this->load->view("layout",$data);	 
    		}
    }
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'member_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Sửa thành viên';
        $data['group'] = $this->group_model->fetchAllGroup();
        $id = $this->uri->segment(4);
        $data['info'] = $this->member_model->fetchOne($id);
            if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("user_name","Tên truy cập","trim|required|min_length[3]|max_length[50]|callback_check_name|xss_clean");
    			$this->form_validation->set_rules("password","Mật khẩu","trim|min_length[4]|max_length[50]|xss_clean");
                $this->form_validation->set_rules("repassword","Nhập lại mật khẩu","trim|matches[password]|xss_clean");
                $this->form_validation->set_rules("user_email","Email","trim|required|valid_email|max_length[100]|xss_clean");
                $this->form_validation->set_rules("fullname","Tên đầy đủ","trim|required|max_length[200]|xss_clean");
                $this->form_validation->set_rules("user_phone","Điện thoại","trim|numeric|max_length[20]|xss_clean");
                $this->form_validation->set_rules("user_mobile","Di động","trim|numeric|max_length[20]|xss_clean");
                $this->form_validation->set_rules("user_yahoo","Tài khoản Yahoo","trim|max_length[50]|xss_clean");
                $this->form_validation->set_rules("user_skype","Tài khoản Skype","trim|max_length[50]|xss_clean");
                $this->form_validation->set_rules("user_facebook","Tài khoản Facebook","trim|max_length[50]|xss_clean");
                $this->form_validation->set_rules("user_order","Thứ tự xắp xếp","trim|numeric|max_length[11]|xss_clean");
                $this->form_validation->set_rules("user_level","Nhóm thành viên","trim|required|xss_clean");
                
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tên truy cập này đã tồn tại. Hãy chọn tên truy cập khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'member/edit';
    				$this->load->view("layout",$data);	
    			}else{
                    $option  = array(
                        "ngaysinh"=>$_POST['user_day'],
                        "thangsinh"=>$_POST['user_month'],
                        "namsinh"=>$_POST['user_year'],
                        "sex"=>$_POST['user_sex'],
                        "address"=>$_POST['user_address'],
                        "phone"=>$_POST['user_phone'],
                        "mobile"=>$_POST['user_mobile'],
                        "yahoo"=>$_POST['user_yahoo'],
                        "yahoo"=>$_POST['user_yahoo'],
                        "facebook"=>$_POST['user_facebook'],
                        "skype"=>$_POST['user_skype'],
                    );
                    $option_text = json_encode($option);
                    $data_user = array(
                        "user_name"=>$_POST['user_name'],
                        "fullname"=>$_POST['fullname'],
                        "user_email"=>$_POST['user_email'],
                        "user_level"=>$_POST['user_level'],
                        "user_active"=>$_POST['user_active'],
                        "created_by"=>$_SESSION['id'],
                        "modified_by"=>$_SESSION['id'],
                        "user_level"=>$_POST['user_level'],
                        "date"  =>time(),
                        "order"  =>$_POST['user_order'],
                        "active"  =>$_POST['user_active'],
                        "user_option"=>$option_text,
                        
                        
                    );
                    if($_POST['user_avatar'] != NULL){
                        $data_user = array(
                            "user_avatar"=>$_POST['user_avatar']
                        );
                    } else {
                        $data_user = array(
                            "user_avatar"=> site_url().'uploads/avatar/no-avatar.jpg'
                        );
                    }
                    if($_POST['password'] != NULL){
                        $data_user = array(
                              "password"=>md5($_POST['password']),
                        );
                    }
    
    				$this->member_model->update($id,$data_user);
    				redirect(base_url('admin/member'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "member/edit";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    
    public function check_name(){
        if($this->uri->segment(4)){
             $id =$this->uri->segment(4);
             
             $check = $this->member_model->check_name($_POST['user_name'],$id);
        }else{
             $check = $this->member_model->check_name($_POST['user_name']);     
        }
        if($check == true){
            return true;
        }else{
            return false;
        }
    }

    
    public function delete() {
        $id = $this->uri->segment(4);
        $this->member_model->delete($id);
        redirect(base_url()."admin/member");
    }
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_user 
                WHERE user_name 
                LIKE '%".$keyword."%'
                ORDER BY user_id ASC";
        $result = $this->member_model->query($sql);
        $data['user'] = $result;
        $data['template'] = "member/search";
		$this->load->view("layout",$data);	 
    }
    

}

