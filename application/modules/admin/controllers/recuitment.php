<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class recuitment extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('recuitment_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->recuitment_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'recuitment_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách tin tuyển dụng';
        $data['recuitment'] = $this->recuitment_model->fetchAll();
        $data['template'] = 'recuitment/default';
        $this->load->view('layout', $data);
    }
    
    public function add(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'recuitment_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = "Thêm tin tuyển dụng mới";
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề tin tuyển dụng","trim|required|callback_check_name|min_length[4]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("detail","Mô tả chi tiết","trim|required|min_length[4]|max_length[20000]|xss_clean");
            $this->form_validation->set_rules("desciption","Mô tả ngắn","min_length[4]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự","numeric|min_length[1]|max_length[3]|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề tuyển dụng đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'recuitment/add';
				$this->load->view("layout",$data);	
			}else{
				$dataAdd = array(
					'name'        =>  $this->input->post('name'),
                    'order'       =>  $this->input->post('order'),
                    'desciption'  =>  $this->input->post('desciption'),
                    'detail'      =>  $this->input->post('detail'),
                    'active'      =>  $this->input->post('active'),
                    'created_by'  =>  $_SESSION['id'],
                    'modified_by' =>  $_SESSION['id'],
                    'date'        =>   mktime(),     
				);

				$this->recuitment_model->add($dataAdd);
				redirect(base_url('admin/recuitment'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "recuitment/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'recuitment_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = "Sửa tin tuyển dụng";
        $segment4 = (int)$this->uri->segment(4);
        $data['recuitment'] = $this->recuitment_model->fetchOne($segment4);
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề tin tuyển dụng","trim|required|callback_check_name|min_length[4]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("detail","Mô tả chi tiết","trim|required|min_length[4]|max_length[20000]|xss_clean");
            $this->form_validation->set_rules("desciption","Mô tả ngắn","min_length[4]|max_length[255]|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự","numeric|min_length[1]|max_length[3]|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề tuyển dụng đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'recuitment/edit';
				$this->load->view("layout",$data);	
			}else{
				$dataEdit = array(
					'name'        =>  $this->input->post('name'),
                    'order'       =>  $this->input->post('order'),
                    'desciption'  =>  $this->input->post('desciption'),
                    'detail'      =>  $this->input->post('detail'),
                    'active'      =>  $this->input->post('active'),
                    'created_by'  =>  $_SESSION['id'],
                    'modified_by' =>  $_SESSION['id'],
                    'date'        =>   mktime(),     
				);

				$this->recuitment_model->update($segment4, $dataEdit);
				redirect(base_url('admin/recuitment'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "recuitment/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'recuitment_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->recuitment_model->delete($id);
        redirect(base_url('admin/recuitment'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_recuitment 
                INNER JOIN tbl_user
                ON tbl_recuitment.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY tbl_recuitment.id ASC";
        $result = $this->recuitment_model->query($sql);
        $data['recuitment'] = $result;
        $data['template'] = "recuitment/search";
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
				$this->recuitment_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->recuitment_model->update($id, $data);
				break;
			}
				redirect(base_url('admin/recuitment'), 'location');
		}
    }
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->recuitment_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

