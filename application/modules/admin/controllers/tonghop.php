<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class tonghop extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('tonghop_model');
    }
    
    public function index()
    {
        $total = $this->tonghop_model->total();
        $this->load->helper("url");
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("admin/tonghop/index");
        $config['total_rows'] = $total;
        $config['per_page'] = 6;
        $config['first_link'] = 'First' ;
        $config['last_link'] = 'Last' ;
        $config["uri_segment"] = 4;
        
        $this->pagination->initialize($config);
        $start = $this->uri->segment(4);
        $data['listnew'] = $this->tonghop_model->list_all($start,$config['per_page']);
        $data['title'] = 'Danh sách bài học';
        $data['template'] = 'tonghop/default';
        $this->load->view('layout', $data);
    }
    public function add(){
        $data['title'] = 'Thêm bài viết mới';
        $data['template'] = 'tonghop/add';
        if(isset($_POST['btnadd'])){
            $this->form_validation->set_rules("news_name","Tên bài viết","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("news_author","Tên người đăng bài","trim|required|xss_clean");
            $this->form_validation->set_rules("post","Chuyên mục đăng","trim|required|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên bài viết đã tồn tại. Hãy chọn tên khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'tonghop/add';
				$this->load->view("layout",$data);	
			}else{
                $data_insert = array(
                    'title'=>$_POST['news_name'],
                    'author'=>$_POST['news_author'],
                    'desc'=>$_POST['desc'],
                    'full'=>$_POST['detail'],
                    'author'=>$_SESSION['id'],
                    'active'=>$_POST['active'],
                    'key'=>$_POST['key'],
                    'meta'=>$_POST['meta'],
                    'post'=>$_POST['post'],
                );
                if($_FILES['img']['name'] != ""){
                    $config['upload_path'] = './uploads/news/news';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '2000';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '1000';
                    $this->load->library('upload', $config);
                    
                    if(!$this->upload->do_upload('img')){
                        $data['errors'] = $this->upload->display_errors("<p></p>");
                        $data['template'] = 'news/add';
                        $this->load->view("layout",$data);
                    }else{
                        $file_info = $this->upload->data();
                        $data_insert['img'] = 'thumb_'.$file_info['file_name'];
                        
                        $config = array(
                            "source_image" =>"./uploads/news/news/".$file_info['file_name'],
    						"new_image" =>"./uploads/news/news/thumbs/",
                            "create_thumb"=> TRUE,
    						"maintain_ration" =>TRUE,
    						"width" =>150,
    						"height" =>150,
                        );
    		          $this->load->library("image_lib",$config);
                          if(!$this->image_lib->resize()){
                            $data['errors'] = $this->image_lib->display_errors();
                          }else{
                             $this->image_lib->resize();
                          }
                    }
                }
                $this->tonghop_model->add($data_insert);
                redirect(base_url()."admin/tonghop");
			}
        }else{
            $this->load->view('layout', $data);   
        }
    }
    public function edit(){
        $id = $this->uri->segment(4);
        $data['info'] = $this->tonghop_model->list_edit($id);
        $data['title'] = "Sửa bài viết";
        $data['template'] ="news/edit";
        if(isset($_POST['btnadd'])){
            $this->form_validation->set_rules("news_name","Tên bài viết","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("news_author","Tên người đăng bài","trim|required|xss_clean");
            $this->form_validation->set_rules("post","Chuyên mục đăng","trim|required|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên bài viết đã tồn tại. Hãy chọn tên khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'tonghop/edit';
				$this->load->view("layout",$data);	
			}else{
                $data_insert = array(
                    'title'=>$_POST['news_name'],
                    'author'=>$_POST['news_author'],
                    'desc'=>$_POST['desc'],
                    'full'=>$_POST['detail'],
                    'author'=>$_SESSION['id'],
                    'active'=>$_POST['active'],
                    'key'=>$_POST['key'],
                    'meta'=>$_POST['meta'],
                    'post'=>$_POST['post'],
                );
                if($_FILES['img']['name'] != ""){
                    $config['upload_path'] = './uploads/news/news';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '2000';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '1000';
                    $this->load->library('upload', $config);
                    
                    if(!$this->upload->do_upload('img')){
                        $data['errors'] = $this->upload->display_errors("<p></p>");
                        $data['template'] = 'tonghop/add';
                        $this->load->view("layout",$data);
                    }else{
                        $file_info = $this->upload->data();
                        $data_insert['img'] = 'thumb_'.$file_info['file_name'];
                        
                        $config = array(
                            "source_image" =>"./uploads/news/news/".$file_info['file_name'],
    						"new_image" =>"./uploads/news/news/thumbs/",
                            "create_thumb"=> TRUE,
    						"maintain_ration" =>TRUE,
    						"width" =>150,
    						"height" =>150,
                        );
    		          $this->load->library("image_lib",$config);
                          if(!$this->image_lib->resize()){
                            $data['errors'] = $this->image_lib->display_errors();
                          }else{
                             $this->image_lib->resize();
                          }
                    }
                }
                $this->tonghop_model->update($data_insert,$id);
                redirect(base_url()."admin/news");
			}
        }else{
            $this->load->view('layout', $data);   
        }
    }
    public function delete() {
        $id = $this->uri->segment(4);        
        $this->news_model->delete($id);
        redirect(base_url('admin/news'), 'refresh');    
	}
    public function active(){
           $id = $this->uri->segment(5);
           if($this->uri->segment(4) == 1){
                $act = 0;
           }else{
                $act = 1;
           }
           $data_active = array(
                'news_active'=>$act,
           );
           $this->news_model->update_active($data_active,$id);
           redirect(base_url().'admin/news');
    }
    public function search()
    {
        if($this->input->post("btnSearch")) {
            $total = $this->news_model->total($this->input->post("keyword"));            
        }else{
            $total = $this->news_model->total();
        }
        $this->load->helper("url");
        $this->load->library('pagination');
        $config['base_url'] = base_url("admin/news/index");
        $config['total_rows'] = $total;
        $config['per_page'] = 6;
        $config['first_link'] = 'First' ;
        $config['last_link'] = 'Last' ;
        $config["uri_segment"] = 4;
        //$config['use_page_numbers'] = TRUE ;
        $this->pagination->initialize($config);
        $start = $this->uri->segment(4);
        if($this->input->post("btnSearch")) {
            $data['listnew'] = $this->news_model->list_all($start,$config['per_page'],$this->input->post("keyword"));
        }else{
            $data['listnew'] = $this->news_model->list_all($start,$config['per_page']);
        }
        $data['title'] = 'Danh sách bài học';
        $data['template'] = 'news/default';
        $this->load->view('layout', $data);
    }
}