<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class menuproduct extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('menuproduct_model');
		$this->load->model('product_model');
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    public function index() {
        $data['title'] = 'Danh mục sản phẩm';
        $data['menuproduct'] = $this->menuproduct_model->fetchAll();
        
        if(isset($_POST['isSort']) && $_POST['isSort'] == 1){
            $cid = $this->input->post('cid');
            $this->menuproduct_model->sort($cid, $order);
            redirect(base_url('admin/menuproduct'), 'location');
        }
        $data['template'] = 'menuproduct/default';
        $this->load->view('layout', $data);
    }
    
    public function add(){
        $data['title'] = "Thêm danh mục sản phẩm";
        $data['menuproduct'] = $this->menuproduct_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tên danh mục sản phẩm","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("parent","Thuộc danh mục","required|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","numeric|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên danh mục đã tồn tại. Hãy chọn tên danh mục khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'menuproduct/add';
				$this->load->view("layout",$data);	
			}else{
			    $this->load->library('string');
				$dataAdd = array(
					'name'         =>  $this->input->post('name'),
					'parent'       =>  $this->input->post('parent'),
					'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'order'        =>  $this->input->post('order'),
                    'option'       =>  '',
                    'active'       =>  $this->input->post('active'),
                    'date'         =>  mktime(),
                    'group'        =>  $this->input->post('group')
                    
				);
				
                //Upload image
				if($_FILES['image']['name'] != NULL){
				    $image_path = './uploads/product/menu/';
					$config['upload_path'] = $image_path;
					$config['allowed_types'] = 'jpg|gif|png|jpeg';
					$config['max_size']	= '1024';
					$config['max_width']  = '1024';
					$config['max_height']  = '1024';
					$config['encrypt_name'] = true;
					$this->load->library('upload');
                    $this->upload->initialize($config);
                    unset($config);
                    if(!$this->upload->do_upload('image')) {
                        $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                        if($error != NULL) {
                            $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                        }
                        $data['template'] = 'menuproduct/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];
                        $dataAdd['image'] = $image;
                        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->menuproduct_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                    }
				}
				//End upload image
				$this->menuproduct_model->add($dataAdd);
				redirect(base_url('admin/menuproduct'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "menuproduct/add";
			$this->load->view("layout",$data);	 
		}
 	}

    public function edit() {
     
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = "Thay đổi danh mục sản phẩm";
        $data['menuproductone'] = $this->menuproduct_model->fetchOne($segment4);
        $data['menuproduct'] = $this->menuproduct_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tên danh mục sản phẩm","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("parent","Thuộc danh mục","required|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","numeric|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên danh mục đã tồn tại. Hãy chọn tên danh mục khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'menuproduct/add';
				$this->load->view("layout",$data);	
			}else{
			    $this->load->library('string');
				$dataEdit = array(
					'name'         =>  $this->input->post('name'),
					'parent'       =>  $this->input->post('parent'),
					'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'order'        =>  $this->input->post('order'),
                    'option'       =>  '',
                    'active'       =>  $this->input->post('active'),
                    'date'         =>  mktime(),
                    'group'        =>  $this->input->post('group')
                    
				);
				
                //Upload image
				if($_FILES['image']['name'] != NULL){
				    $image_path = './uploads/product/menu/';
					$config['upload_path'] = $image_path;
					$config['allowed_types'] = 'jpg|gif|png|jpeg';
					$config['max_size']	= '1024';
					$config['max_width']  = '1024';
					$config['max_height']  = '1024';
					$config['encrypt_name'] = true;
					$this->load->library('upload');
                    $this->upload->initialize($config);
                    unset($config);
                    if(!$this->upload->do_upload('image')) {
                        $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                        if($error != NULL) {
                            $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                        }
                        $data['template'] = 'menuproduct/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];
                        $dataEdit['image'] = $image;
                        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->menuproduct_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                    }
				}
				//End upload image
				$this->menuproduct_model->update($segment4, $dataEdit);
				redirect(base_url('admin/menuproduct'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "menuproduct/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        $segment4 = $this->uri->segment(4);
        $menuproduct = $this->menuproduct_model->fetchAll();
        $system = new recursive($menuproduct);
        $newArr = $system->buildArray($segment4); 
        $tmp = array();
        if(count($newArr) > 0) {
            foreach($newArr as $key=>$val) {
                $tmp[] =  $val['id'];
            }
            array_unshift($tmp, $segment4);
            $this->menuproduct_model->delete($tmp, 'id');
			$this->product_model->delete($tmp,'menu_id');
        } else {
            $this->menuproduct_model->delete($segment4, 'id');
			$this->product_model->delete($segment4,'menu_id');
        }
        redirect(base_url('admin/menuproduct'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_menu_product
                INNER JOIN tbl_user
                ON tbl_menu_product.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->menuproduct_model->query($sql);
        $data['menuproduct'] = $result;
        $data['template'] = "menuproduct/search";
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
				$this->menuproduct_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->menuproduct_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/menuproduct'), 'location');
		}
    }
        
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->menuproduct_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}


