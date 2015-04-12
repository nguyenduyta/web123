<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery extends CI_Controller {
    public function __construct(){
        session_start();
        parent::__construct();
        if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("gallery_model");
         $this->load->model("categallery_model");
         $this->load->model("product_model");
    }
    public function index(){
        $data['listGallery'] = $this->gallery_model->getAll();
        $data['title'] = "Danh sách Gallery";
        $data['template'] ="gallery/default";
        $this->load->view('layout',$data);
    }
    public function add(){
        $data['listcate'] = $this->categallery_model->fetchAll();
        $data['title'] ="Thêm Gallery";
        $data['template'] = "gallery/add";
        if(isset($_POST['btnAdd'])){
            
            $this->form_validation->set_rules("catega","Chuyên mục","trim|required|xss_clean");
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
                $data['template'] = 'gallery/add';
				$this->load->view("layout",$data);	
			}else{
			     $dataInsert = array(
                    "ga_cate"=>$_POST['catega'],
                    "ga_name"=>$_POST['nametype'],
                    "ga_date"=>time()
                 );
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
                        $data['template'] = 'gallery/add';
                        $this->load->view('layout', $data);
                        return false;
                    }else{
                        $file_info = $this->upload->data();
                        $image1 = $file_info['file_name'];
                        $dataInsert['ga_img'] = $image1; 
                        //resize imgage
                        $width  = 130;
                        $height = 130;
                        $this->product_model->resizeImage($image_path, $image1, $width, $height);
                        //end resize image
                   }
				}else{
				    $dataInsert['ga_img'] = 'no-image.png';
				}
                $this->gallery_model->add($dataInsert);
                redirect(base_url('admin/gallery'));
			}
            
        }else{
            $this->load->view("layout",$data);   
        }
    }
    public function edit(){
        $id = $this->uri->segment(4);
        $data['listcate'] = $this->categallery_model->fetchAll();
        $data['info'] = $this->gallery_model->getOnce($id);
        $data['title'] = "Sửa Gallery";
        $data['template'] = "gallery/edit";
        if(isset($_POST['btnAdd'])){
            
            $this->form_validation->set_rules("catega","Chuyên mục","trim|required|xss_clean");
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
                $data['template'] = 'gallery/edit';
				$this->load->view("layout",$data);	
			}else{
			     $dataInsert = array(
                    "ga_cate"=>$_POST['catega'],
                    "ga_name"=>$_POST['nametype'],
                    "ga_date"=>time()
                 );
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
                        $data['template'] = 'gallery/edit';
                        $this->load->view('layout', $data);
                        return false;
                    }else{
                        $file_info = $this->upload->data();
                        $image1 = $file_info['file_name'];
                        $dataInsert['ga_img'] = $image1; 
                        //resize imgage
                        $width  = 130;
                        $height = 130;
                        $this->product_model->resizeImage($image_path, $image1, $width, $height);
                        //end resize image
                   }
                $this->gallery_model->update($id,$dataInsert);
                    redirect(base_url('admin/gallery'));
                }
                }
			}else{
                $this->load->view("layout",$data);
            }
   
    }
    public function delete(){
        $this->gallery_model->delete($this->uri->segment(4));
        redirect(base_url('admin/gallery'));       
    }
}