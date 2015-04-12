<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class menunews extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('menunews_model');
        $this->load->model('news_model');
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
   	    }
    }
    public function index(){
        $data['title'] = 'Danh mục tin tức';
        $data['menunews'] = $this->menunews_model->fetchAll();
        $data['template'] = 'menunews/default';
        $this->load->view('layout', $data);
    }
    public function add(){
        $data['title'] = "Thêm danh mục tin tức";
        $data['menuproduct'] = $this->menunews_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tên danh mục tin tức","trim|required|callback_check_name|xss_clean");
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
                $data['template'] = 'menunews/add';
				$this->load->view("layout",$data);	
			}else{
			    $this->load->library('string');
				$dataAdd = array(
					'name'         =>  $this->input->post('name'),
'info'         =>  $this->input->post('desciption'),
					'parent'       =>  $this->input->post('parent'),
					'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'order'        =>  $this->input->post('order'),
'meta'        =>  $this->input->post('meta'),
'key'        =>  $this->input->post('key'),
                    'option'       =>  '',
                    'active'       =>  $this->input->post('active'),
                    'date'         =>  mktime()
				);
                //Upload image
				if($_FILES['image']['name'] != NULL){
				    $image_path = './uploads/news/menu/';
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
                        $data['template'] = 'menunews/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];
                        $dataAdd['images'] = $image;
                        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->menunews_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                    }
				}
				//End upload image
				$this->menunews_model->add($dataAdd);
				redirect(base_url('admin/menunews'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "menunews/add";
			$this->load->view("layout",$data);	 
		}
 	}
    public function edit() {
        $id = (int)$this->uri->segment(4);
        $data['info'] = $this->menunews_model->info_edit($id);
        $data['title'] = "Sửa danh mục tin tức";
        $data['template']="menunews/edit";
        $data['menunews'] = $this->menunews_model->fetchAll();
        if(isset($_POST['btnEdit'])){
			$this->form_validation->set_rules("name","Tên danh mục tin tức","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
            $this->form_validation->set_rules("parent","Thuộc danh mục","xss_clean");
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
                        $data['template'] = 'menunews/edit';
        				$this->load->view("layout",$data);	
                }else{
                    $dataEdit = array(
    					'name'         =>  $this->input->post('name'),
    					'parent'       =>  $this->input->post('parent'),
'info'         =>  $this->input->post('desciption'),
    					'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'order'        =>  $this->input->post('order'),
'meta'        =>  $this->input->post('meta'),
'key'        =>  $this->input->post('key'),
                        'option'       =>  '',
                        'active'       =>  $this->input->post('active'),
                        'date'         =>  mktime()
                    );
					 //Upload image
				if($_FILES['image']['name'] != NULL){
				    $image_path = './uploads/news/menu/';
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
                        $data['template'] = 'menunews/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];
                        $dataEdit['images'] = $image;
                        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->menunews_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                    }
				}
				//End upload image
					
                    $this->menunews_model->update($id,$dataEdit);
                    redirect(base_url('admin/menunews'), 'location');
                }
        }else{
            $this->load->view('layout',$data);
        }
    }
    public function delete() {
        $segment4 = $this->uri->segment(4);
        $menunews = $this->menunews_model->fetchAll();
        $system = new recursive($menunews);
        $newArr = $system->buildArray($segment4); 
        $tmp = array();
        if(count($newArr) > 0) {
            foreach($newArr as $key=>$val) {
                $tmp[] =  $val['id'];
            }
            array_unshift($tmp, $segment4);
            $this->menunews_model->delete($tmp, 'id');
            $this->news_model->delete($tmp, 'news_menu');
        } else {
            $this->menunews_model->delete($segment4, 'id');
			$this->news_model->delete($segment4,'news_menu');
        }
        redirect(base_url('admin/menunews'), 'refresh');    
    }
    
    public function sort() {
       $order = $this->input->post('order');
       $id = $this->input->post('id');
       $data_sort = array(
            "order"=>$order
       );
       $this->menunews_model->update($id,$data_sort);
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
				$this->menunews_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->menunews_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/menunews'), 'location');
		}
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['menunews'] = $this->menunews_model->fetchAll();
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_menu_news 
                INNER JOIN tbl_user
                ON tbl_menu_news.created_by = tbl_user.user_id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY id ASC";
        $result = $this->menunews_model->query($sql);
        $data['menunews'] = $result;
        $data['template'] = "menunews/search";
		$this->load->view("layout",$data);	 
    }
    

    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->menunews_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}
