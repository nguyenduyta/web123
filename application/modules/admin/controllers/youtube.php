<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class youtube extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('youtube_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->youtube_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'video_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách Video Youtube';
        $data['youtube'] =  $this->youtube_model->fetchAll();
        $data['template'] = 'youtube/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'video_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm mới youtube';
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề youtube","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("link","Link youtube","trim|required|min_length[4]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","trim|numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề youtube đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'youtube/add';
				$this->load->view("layout",$data);	
			}else{
                $link = $this->input->post('link');
                $arrLink = explode("?", $link);
                $arrLink1 = str_replace('v=', '', $arrLink[1]);
                
				$dataAdd = array(
                    'name'         =>  $this->input->post('name'),
					'link'         =>  $arrLink1,
					'order'        =>  $this->input->post('order'),
					'width'        =>  $this->input->post('width'),
					'height'       =>  $this->input->post('height'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->youtube_model->add($dataAdd);
				redirect(base_url('admin/youtube'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "youtube/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'video_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thay đổi youtube';
        $segment4 = (int)$this->uri->segment(4);
        $data['youtube'] = $this->youtube_model->fetchOne($segment4);
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề youtube","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("link","Link youtube","trim|required|min_length[4]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","trim|numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề youtube đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'youtube/add';
				$this->load->view("layout",$data);	
			}else{
                $link = $this->input->post('link');
                $arrLink = explode("?", $link);
                $arrLink1 = str_replace('v=', '', $arrLink[1]);
                
				$dataEdit = array(
                    'name'         =>  $this->input->post('name'),
					'link'         =>  $arrLink1,
					'order'        =>  $this->input->post('order'),
					'width'        =>  $this->input->post('width'),
					'height'       =>  $this->input->post('height'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->youtube_model->update($segment4, $dataEdit);
				redirect(base_url('admin/youtube'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "youtube/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'video_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->youtube_model->delete($id);
        redirect(base_url('admin/youtube'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_youtube 
                INNER JOIN tbl_user
                ON tbl_youtube.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->youtube_model->query($sql);
        $data['youtube'] = $result;
        $data['template'] = "youtube/search";
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
				$this->youtube_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->youtube_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/youtube'), 'location');
		}
    }
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->youtube_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

