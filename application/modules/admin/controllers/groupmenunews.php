<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class groupmenunews extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('groupmenunews_model');
		$this->load->model('post_model');
        $this->load->model("product_model");
        
	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->groupmenunews_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index(){
        $data['title'] = 'Danh sách loại bài viết';
        $data['groupmenunews'] = $this->groupmenunews_model->fetchAll();
        $data['template'] = 'groupmenunews/default';
        $this->load->view('layout', $data);
    }
    public function add(){
        $data['title'] = 'Thêm loại bài viết';
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("nametype","Tiêu đề loại tin tức","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("ordertype","Thứ tự xắp xếp","trim|numeric|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề loại tin tức đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'groupmenunews/add';
				$this->load->view("layout",$data);	
			}else{
			    $this->load->library('string');
				$dataAdd = array(
					'nametype'     =>  $this->input->post('nametype'),
                    'desc'         =>  $this->input->post('desc'),
                    'key'         =>  $this->input->post('key'),
                    'meta'         =>  $this->input->post('meta'),
					'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'ordertype'    =>  $this->input->post('ordertype'),
                    'activetype'   =>  $this->input->post('activetype'),
                    'date'         =>  mktime()
				);
				$this->groupmenunews_model->add($dataAdd);
				redirect(base_url('admin/groupmenunews'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "groupmenunews/add";
			$this->load->view("layout",$data);	 
		}
    }
    public function edit(){
        $data['title'] = 'Sửa loại bài viết';
        $segment4 = (int)$this->uri->segment(4);
        $data['groupmenunews'] = $this->groupmenunews_model->fetchOne($segment4);
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("nametype","Tiêu đề loại tin tức","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("ordertype","Thứ tự xắp xếp","trim|numeric|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề loại tin tức đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'groupmenunews/edit';
				$this->load->view("layout",$data);	
			}else{
			    $this->load->library('string');
				$dataEdit = array(
					'nametype'     =>  $this->input->post('nametype'),
                    'desc'         =>  $this->input->post('desciption'),
                    'key'         =>  $this->input->post('key'),
                    'meta'         =>  $this->input->post('meta'),
					'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'ordertype'    =>  $this->input->post('ordertype'),
                    'activetype'   =>  $this->input->post('activetype'),
                    'date'         =>  mktime()
				);
                //Upload image 1
				if($_FILES['img']['name'] != NULL){
				    $image_path = './uploads/product/product/';
					$config['upload_path'] = $image_path;
					$config['allowed_types'] = 'jpg|gif|png|jpeg';
					$config['max_size']	= '2048';
					$config['max_width']  = '2048';
					$config['max_height']  = '2048';
					$config['encrypt_name'] = true;
					$this->load->library('upload');
                    $this->upload->initialize($config);
                    unset($config);
                    if(!$this->upload->do_upload('img')) {
                        $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                        if($error != NULL) {
                            $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                        }
                        $data['template'] = 'groupmenunews/edit';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image1 = $file_infor['file_name'];
                        $dataEdit['images'] = $image1;
                        //resize imgage
                        $width  = 100;
                        $height = 74;
                        $this->product_model->resizeImage($image_path,$image1, $width, $height);
                        //end resize image
                    }
				} 
				//End upload image 1
				$this->groupmenunews_model->update($segment4, $dataEdit);
				redirect(base_url('admin/groupmenunews'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "groupmenunews/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'groupmenunews_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->groupmenunews_model->delete($id);
		$this->post_model->delete_group($id);
        redirect(base_url('admin/groupmenunews'),'refresh');    
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
                $data = array('activetype'=>1);
				$this->groupmenunews_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('activetype'=>0);
				$this->groupmenunews_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/groupmenunews'), 'location');
		}
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT * 
                FROM tbl_groupmenu_news 
                INNER JOIN tbl_user
                ON tbl_groupmenu_news.created_by = tbl_user.user_id
                WHERE nametype 
                LIKE '%".$keyword."%'
                ORDER BY tbl_groupmenu_news.id ASC";
        $result = $this->groupmenunews_model->query($sql);
        $data['result'] = $result;
        $data['template'] = "groupmenunews/search";
		$this->load->view("layout",$data);	 
    }
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->groupmenunews_model->check_name($this->input->post('nametype'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

