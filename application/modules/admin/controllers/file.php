<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class file extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('file_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->file_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'file_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách tập tin';
        $data['file'] = $this->file_model->fetchAll();
        $data['template'] = 'file/default';
        $this->load->view('layout', $data);
    }
    
    public function add(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'file_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm mới tập tin';
        
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề tập tin","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("file","Tập tin","required|max_length[255]|xss_clean");
            $this->form_validation->set_rules("price","Giá","trim|numeric|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề tập tin đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'file/add';
				$this->load->view("layout",$data);	
			}else{
                if($this->input->post('charge') == 'div1') {
                    $price = $this->input->post('price');
                } else {
                    $price = 0;
                }
				$dataAdd = array(
                    'name'         =>  $this->input->post('name'),
					'order'        =>  $this->input->post('order'),
                    'price'        =>  $price,
                    'image'        =>  $this->input->post('image'),
                    'file'         =>  $this->input->post('file'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->file_model->add($dataAdd);
				redirect(base_url('admin/file'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "file/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'file_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Thay đổi tập tin';
        $data['file'] = $file = $this->file_model->fetchOne($segment4);
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề tập tin","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("file","Tập tin","required|max_length[255]|xss_clean");
            $this->form_validation->set_rules("price","Giá","trim|numeric|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề file đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'file/add';
				$this->load->view("layout",$data);	
			}else{
                if($this->input->post('charge') == 'div1') {
                    $price = $this->input->post('price');
                } else {
                    $price = $file['price'];
                }
				$dataEdit = array(
                    'name'         =>  $this->input->post('name'),
					'order'        =>  $this->input->post('order'),
                    'price'        =>  $price,
                    'image'        =>  $this->input->post('image'),
                    'file'         =>  $this->input->post('file'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->file_model->update($segment4, $dataEdit);
				redirect(base_url('admin/file'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "file/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'file_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->file_model->delete($id);
        redirect(base_url('admin/file'), 'refresh');    
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
				$this->file_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->file_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/file'), 'location');
		}
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_file 
                INNER JOIN tbl_user
                ON tbl_file.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->file_model->query($sql);
        $data['file'] = $result;
        $data['template'] = "file/search";
		$this->load->view("layout",$data);	 
    }
}

