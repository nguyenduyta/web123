<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categallery extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
         $this->load->model('categallery_model');
         $this->load->model('product_model');
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    public function index(){
        $data['listcate']  = $this->categallery_model->fetchAll();
        $data['title'] = 'Danh sách loại Gallery';
        $data['template'] = 'categallery/default';
        $this->load->view('layout', $data);
    }
    public function add(){
        $data['title'] = 'Thêm loại Gallery';
    	if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("nametype","Tên","trim|required|xss_clean");
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
                $data['template'] = 'categallery/add';
				$this->load->view("layout",$data);	
			}else{
			     $dataInsert = array(
                    "name"=>$_POST['nametype']
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
                    if(!$this->upload->do_upload('img')){
                            $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                            if($error != NULL) {
                                $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                            }
                        $data['template'] = 'categallery/add';
                        $this->load->view('layout', $data);
                        return false;
                    }else{
                        $file_info = $this->upload->data();
                        $image1 = $file_info['file_name'];
                        $dataInsert['img'] = $image1; 
                        //resize imgage
                        $width  = 130;
                        $height = 130;
                        $this->product_model->resizeImage($image_path, $image1, $width, $height);
                        //end resize image
                   }
				}else{
				    $dataInsert['img'] = 'no-image.png';
				}
				//End upload image 1
                $this->categallery_model->add($dataInsert);
                redirect(base_url('admin/categallery'));
			}
		//Load view
		}else{
            $data['template'] = "categallery/add";
			$this->load->view("layout",$data);	 
		}
    }
    public function edit(){
        $data['title'] = 'Sửa gallery';
        $segment4 = (int)$this->uri->segment(4);
        $data['info'] = $this->categallery_model->fetchOne($segment4);
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("nametype","Tên","trim|required|xss_clean");
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
                $data['template'] = 'categallery/edit';
				$this->load->view("layout",$data);	
			}else{
			     $dataInsert = array(
                    "name"=>$_POST['nametype']
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
                    if(!$this->upload->do_upload('img')){
                            $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                            if($error != NULL) {
                                $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                            }
                        $data['template'] = 'categallery/edit';
                        $this->load->view('layout', $data);
                        return false;
                    }else{
                        $file_info = $this->upload->data();
                        $image1 = $file_info['file_name'];
                        $dataInsert['img'] = $image1; 
                        //resize imgage
                        $width  = 130;
                        $height = 130;
                        $this->product_model->resizeImage($image_path, $image1, $width, $height);
                        //end resize image
                   }
				}
				//End upload image 1
                $this->categallery_model->update($segment4,$dataInsert);
                redirect(base_url('admin/categallery'));
			}
		//Load view
		}else{
            $data['template'] = "categallery/edit";
			$this->load->view("layout",$data);	 
		}
	
    }
    
    public function delete() {
        $id = $this->uri->segment(4);        
        $this->categallery_model->delete($id);
        redirect(base_url('admin/categallery'),'refresh');    
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
}

