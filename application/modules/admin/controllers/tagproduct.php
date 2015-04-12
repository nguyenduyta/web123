<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tagproduct extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('product_model');
        $this->load->model('tagproduct_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->tagproduct_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'tagproduct_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách Tag sản phẩm';
        $data['tagproduct'] = $this->tagproduct_model->fetchAll();
        $data['template'] = 'tagproduct/default';
        $this->load->view('layout', $data);
    }
    
    public function add(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'tagproduct_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm mới Tag sản phẩm';
        $query = 'SELECT *
                  FROM tbl_product
                  ORDER BY id DESC';
        $data['product'] = $this->product_model->queryProduct($query);
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề tagproduct","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("productlink","Link liên kết","trim|required|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề Tag sản phẩm đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'tagproduct/add';
				$this->load->view("layout",$data);	
			}else{
                $link = $this->input->post('productlink');
				$dataAdd = array(
                    'name'         =>  $this->input->post('name'),
                    'open'         =>  $this->input->post('open'),
					'link'         =>  $link,
					'order'        =>  $this->input->post('order'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->tagproduct_model->add($dataAdd);
				redirect(base_url('admin/tagproduct'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "tagproduct/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'tagproduct_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Thay đổi Tag sản phẩm';
        $query = 'SELECT *
                  FROM tbl_product
                  ORDER BY id DESC';
        $data['product'] = $this->product_model->queryProduct($query);
        $data['tagproduct'] = $this->tagproduct_model->fetchOne($segment4);
        $tagproduct = $this->tagproduct_model->fetchOne($segment4);;
        
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề Tag sản phẩm","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("productlink","Link liên kết","trim|required|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề Tag sản phẩm đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'tagproduct/edit';
				$this->load->view("layout",$data);	
			}else{
                $link = $this->input->post('productlink');
				$dataEdit = array(
                    'name'         =>  $this->input->post('name'),
                    'open'         =>  $this->input->post('open'),
					'link'         =>  $link,
					'order'        =>  $this->input->post('order'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->tagproduct_model->update($segment4, $dataEdit);
				redirect(base_url('admin/tagproduct'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "tagproduct/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'tagproduct_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->tagproduct_model->delete($id);
        redirect(base_url('admin/tagproduct'), 'refresh');    
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
				$this->tagproduct_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->tagproduct_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/tagproduct'), 'location');
		}
    }
    
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_tag
                INNER JOIN tbl_user
                ON tbl_tag.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->tagproduct_model->query($sql);
        $data['tagproduct'] = $result;
        $data['template'] = "tagproduct/search";
		$this->load->view("layout",$data);	 
    }
    
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->tagproduct_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}   

