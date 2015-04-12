<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class brand extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('brand_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->brand_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
       
		//End Check permission
        $data['title'] = 'Danh sách hãng sản xuất';
        $data['brand'] = $this->brand_model->fetchAll();
        $data['template'] = 'brand/default';
        $this->load->view('layout', $data);
    }
    
    public function add(){
       
        $data['title'] = 'Thêm mới hãng sản xuất';
        $data['post'] = $this->brand_model->fetchAll();
        //$data['news'] = $this->news_model->fetchAll();
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("brandname","Tên hãng","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("brandimage","Hình ảnh","trim|xss_clean");
            $this->form_validation->set_rules("brandorder","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên hãng đã tồn tại. Hãy chọn tên hãng khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'brand/add';
				$this->load->view("layout",$data);	
			}else{
                
				$dataAdd = array(
                    'brandname'    =>  $this->input->post('brandname'),
					'brandimage'   =>  $this->input->post('brandimge'),
                    'brandorder'   =>  $this->input->post('brandorder'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'branddate'    =>  mktime(),
                    'brandtag'     =>  $this->string->replace($this->input->post('brandname')), 
                    'brandactive'  =>  $this->input->post('brandactive'),
				);

				$this->brand_model->add($dataAdd);
				redirect(base_url('admin/brand'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "brand/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit(){
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Sửa hãng sản xuất';
        $data['brand'] = $this->brand_model->fetchOne($segment4);
        
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("brandname","Tên hãng","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("brandimage","Hình ảnh","trim|xss_clean");
            $this->form_validation->set_rules("brandorder","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên hãng đã tồn tại. Hãy chọn tên hãng khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'brand/edit';
				$this->load->view("layout",$data);	
			}else{
				$dataEdit = array(
                    'brandname'         =>  $this->input->post('brandname'),
					'brandimage'        =>  $this->input->post('brandimage'),
					'brandorder'        =>  $this->input->post('brandorder'),
                    'created_by'        =>  $_SESSION['id'],
                    'modified_by'       =>  $_SESSION['id'],
                    'branddate'         =>  mktime(),
                    'brandtag'          =>  $this->string->replace($this->input->post('brandname')),
                    'brandactive'       =>  $this->input->post('brandactive'),
				);

				$this->brand_model->update($segment4, $dataEdit);
				redirect(base_url('admin/brand'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "brand/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'brand_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->brand_model->delete($id);
        redirect(base_url('admin/brand'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT * 
                FROM tbl_brand
                INNER JOIN tbl_user
                ON tbl_brand.created_by = tbl_user.user_id
                WHERE brandname 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->brand_model->query($sql);
        $data['brand'] = $result;
        $data['template'] = "brand/search";
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
                $data = array('brandactive'=>1);
				$this->brand_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('brandactive'=>0);
				$this->brand_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/brand'), 'location');
		}
    }
  
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->brand_model->check_name($this->input->post('brandname'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

