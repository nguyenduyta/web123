<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class post extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('post_model');
        $this->load->model('groupmenunews_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->post_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index() {
        $data['title'] = 'Danh sách bài viết';
        $total = $this->post_model->total();
        $this->load->helper("url");
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("admin/post/index");
        $config['total_rows'] = $total;
        $config['per_page'] = 6;
        $config['first_link'] = 'First' ;
        $config['last_link'] = 'Last' ;
        $config["uri_segment"] = 4;
        
        $this->pagination->initialize($config);
        $start = $this->uri->segment(4);
        $data['post']  = $this->post_model->fetchAll($start,$config['per_page']);
        
        $data['template'] = 'post/default';
        $this->load->view('layout', $data);
    }
    public function add(){
        $data['title'] = "Thêm bài viết mới";
        $data['posttype'] = $this->groupmenunews_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề bài viết","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("detail","Mô tả chi tiết","trim|required|xss_clean");
            $this->form_validation->set_rules("desciption","Mô tả ngắn","|xss_clean");
            $this->form_validation->set_rules("order","Thứ tự","numeric|min_length[1]|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề bài viết đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'post/add';
				$this->load->view("layout",$data);	
			}else{
				$dataAdd = array(
					'name'        =>  $this->input->post('name'),
                    'meta'        =>  $this->input->post('meta'),
                    'key'        =>  $this->input->post('key'),
                    'order'       =>  $this->input->post('order'),
                    'desciption'  =>  $this->input->post('desciption'),
                    'detail'      =>  $this->input->post('detail'),
                    'posttype'    =>  $this->input->post('posttype'),
                    'active'      =>  $this->input->post('active'),
                    'created_by'  =>  $_SESSION['id'],
                    'modified_by' =>  $_SESSION['id'],
                    'date'        =>   mktime(),
                       
				);
				
                ///////////////////////////////Upload image
                //Upload image 1
				if($_FILES['image']['name'] != NULL){
				    $image_path = './uploads/post/';
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
                        
                        $data['template'] = 'post/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];
                        $dataAdd['image'] = $image;
                        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->post_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                    }
				} else {
				    $dataAdd['image'] = 'no-image.png';
				}
				//End upload image 1

                //////////////////////////////End upload image

				$this->post_model->add($dataAdd);
                $lastId = $this->db->insert_id(); 
                $link = $this->post_model->fetchOne($lastId);
                $links = 'bai-viet/'.$link['id'].'/'.strtolower($this->string->replace($link['name']));
				$dataEdit = array(
					'link'     =>    $links
				);
    			$this->post_model->update($lastId, $dataEdit);
				redirect(base_url('admin/post'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "post/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit() {
        $data['title'] = "Thay đổi thông tin bài viết";
        $segment4 = (int)$this->uri->segment(4);
        $data['post'] = $post = $this->post_model->fetchOne($segment4);
        $data['posttype'] = $this->groupmenunews_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("name","Tiêu đề bài viết","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("detail","Mô tả chi tiết","trim|required|xss_clean");
            $this->form_validation->set_rules("desciption","Mô tả ngắn","xss_clean");
            $this->form_validation->set_rules("order","Thứ tự","numeric|min_length[1]|max_length[11]|xss_clean");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tiêu đề bài viết đã tồn tại. Hãy chọn tiêu đề khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'post/edit';
				$this->load->view("layout",$data);	
			}else{
				$dataEdit = array(
					'name'        =>  $this->input->post('name'),
                    'order'       =>  $this->input->post('order'),
                    'meta'        =>  $this->input->post('meta'),
                    'key'        =>  $this->input->post('key'),
                    'desciption'  =>  $this->input->post('desciption'),
                    'detail'      =>  $this->input->post('detail'),
                    'posttype'    =>  $this->input->post('posttype'),
                    'active'      =>  $this->input->post('active'),
                    'created_by'  =>  $_SESSION['id'],
                    'modified_by' =>  $_SESSION['id'],
                    'date'        =>   mktime(),
                       
				);
				
                ///////////////////////////////Upload image
                //Upload image 1
				if($_FILES['image']['name'] != NULL){
				    $image_path = './uploads/post/';
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
                        
                        $data['template'] = 'post/edit';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];
                        $dataEdit['image'] = $image;
                        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->post_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                    }
				} else {
				    $dataEdit['image'] = $post['image'];
				}         
                //////////////////////////////End upload image
                $dataEdit['link'] = 'bai-viet/'.$post['id'].'/'.strtolower($this->string->replace($this->input->post('name')));
				$this->post_model->update($segment4, $dataEdit);
				redirect(base_url('admin/post'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "post/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    
    public function delete() {
        //Check permisson
  		if(!$this->check->is_allowed($_SESSION['permission'], 'post_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->post_model->delete($id);
        redirect(base_url('admin/post'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_post 
                INNER JOIN tbl_user
                ON tbl_post.created_by = tbl_user.user_id
                INNER JOIN tbl_groupmenu_news
                ON tbl_post.posttype = tbl_groupmenu_news.id
                WHERE name 
                LIKE '%".$keyword."%'
                ORDER BY tbl_post.id ASC";
        $result = $this->post_model->query($sql);
        $data['post'] = $result;
        $data['template'] = "post/search";
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
				$this->post_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('active'=>0);
				$this->post_model->update($id, $data);
				break;
			}
				redirect(base_url('admin/post'), 'location');
		}
    }
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->post_model->check_name($this->input->post('name'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

