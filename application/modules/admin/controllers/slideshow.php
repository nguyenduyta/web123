<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class slideshow extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        //$this->load->model('slideshow_model');
        $this->load->model('post_model');
        $this->load->model('product_model');
        $this->load->model('slideshow_model');
        $this->load->model('news_model');
        
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->slideshow_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'slideshow_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách slideshow';
        $data['slideshow'] = $this->slideshow_model->fetchAll();
        $data['template'] = 'slideshow/default';
        $this->load->view('layout', $data);
    }
    
    public function add(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'slideshow_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm mới Slideshow';
        $query1 = 'SELECT *
                   FROM tbl_post
                   ORDER BY id ASC';
        $data['post'] = $this->post_model->query($query1);
        $query2 = 'SELECT *
                   FROM tbl_news
                   ORDER BY news_id ASC';
        $data['news'] = $this->news_model->query($query2);
        $query3 = 'SELECT *
                   FROM tbl_product
                   ORDER BY id ASC';
        $data['product'] = $this->product_model->queryProduct($query3);
        
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề Slideshow","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("image","Hình ảnh","trim|required|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề slideshow đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'slideshow/add';
				$this->load->view("layout",$data);	
			}else{
			 
                if($this->input->post('textlink')) {
                    $link = 'http://'.$this->input->post('textlink');
                } elseif($this->input->post('postlink')) {
                    $link=  $this->input->post('postlink');
                } elseif($this->input->post('newslink')) {
                    $link = $this->input->post('newslink');
                } elseif($this->input->post('productlink')) {
                    $link = $this->input->post('productlink');
                }
                
				$dataAdd = array(
                    'name'         =>  $this->input->post('name'),
					'image'        =>  $this->input->post('image'),
					'order'        =>  $this->input->post('order'),
					'pos'        =>  $this->input->post('pos'),					
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->slideshow_model->add($dataAdd);
				redirect(base_url('admin/slideshow'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "slideshow/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'slideshow_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Thay đổi Slideshow';
        $query1 = 'SELECT *
                   FROM tbl_post
                   ORDER BY id ASC';
        $data['post'] = $this->post_model->query($query1);
        $query2 = 'SELECT *
                   FROM tbl_news
                   ORDER BY news_id ASC';
        $data['news'] = $this->news_model->query($query2);
        $query3 = 'SELECT *
                   FROM tbl_product
                   ORDER BY id ASC';
        $data['product'] = $this->product_model->queryProduct($query3);
        $data['slideshow'] = $slideshow = $this->slideshow_model->fetchOne($segment4);
        
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề Slideshow","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("image","Hình ảnh","trim|required|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề Slideshow đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'slideshow/edit';
				$this->load->view("layout",$data);	
			}else{
			 
                if($this->input->post('textlink') == '') {
                    $link = $slideshow['link'];
                } else {
                    $link = $this->input->post('textlink');
                }
                if($this->input->post('postlink')) {
                   $link = $this->input->post('postlink');  
                }
                 
                if($this->input->post('newslink')) {
                    $link = $this->input->post('newslink');
                }
                
                if($this->input->post('productlink')) {
                    $link = $this->input->post('productlink');
                }
                    
				$dataEdit = array(
                    'name'         =>  $this->input->post('name'),
					'image'        =>  $this->input->post('image'),
					'order'        =>  $this->input->post('order'),
					'pos'        =>  $this->input->post('pos'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'active'       =>  $this->input->post('active'),
				);

				$this->slideshow_model->update($segment4, $dataEdit);
				redirect(base_url('admin/slideshow'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "slideshow/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'slideshow_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->slideshow_model->delete($id);
        redirect(base_url('admin/slideshow'), 'refresh');    
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
				$this->slideshow_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->slideshow_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/slideshow'), 'location');
		}
    }
        
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_slideshow 
                INNER JOIN tbl_user
                ON tbl_slideshow.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->slideshow_model->query($sql);
        $data['slideshow'] = $result;
        $data['template'] = "slideshow/search";
		$this->load->view("layout",$data);	 
    }
    
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->slideshow_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}   

