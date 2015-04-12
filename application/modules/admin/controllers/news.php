<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class news extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('menunews_model');
         $this->load->model('news_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->news_model->delete($idGroup, 'news_id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    public function index()
    {
        $total = $this->news_model->total();
        $this->load->helper("url");
        $this->load->library('pagination');
        
        $config['base_url'] = base_url("admin/news/index");
        $config['total_rows'] = $total;
        $config['per_page'] = 6;
        $config['first_link'] = 'First' ;
        $config['last_link'] = 'Last' ;
        $config["uri_segment"] = 4;
        
        $this->pagination->initialize($config);
        $start = $this->uri->segment(4);
        $data['listnew'] = $this->news_model->list_all($start,$config['per_page']);
        $data['title'] = 'Danh sách bài học';
        $data['page']  = $this->uri->segment(4);
        $data['template'] = 'news/default';
        $this->load->view('layout', $data);
        
    }
    public function add(){
        $data['menuproduct'] = $this->menunews_model->fetchAll();
        $data['title'] = 'Thêm tin tức';
        $data['template'] = 'news/add';
        if(isset($_POST['btnadd'])){
            $this->form_validation->set_rules("news_name","Tên bài viết","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("news_author","Tên người đăng bài","trim|required|xss_clean");
            $this->form_validation->set_rules("parent","Thuộc danh mục","required|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","numeric|xss_clean");
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
                $data['template'] = 'news/add';
				$this->load->view("layout",$data);	
			}else{
                $data_insert = array(
                    'news_name'=>$_POST['news_name'],
                    'news_author'=>$_POST['news_author'],
                    'news_desc'=>$_POST['desc'],
                    'news_full'=>$_POST['detail'],
                    'created_by'=>$_SESSION['id'],
                    'modified_by'=>$_SESSION['id'],
                    'news_active'=>$_POST['active'],
                    'news_order'=>$_POST['porder'],
                    'news_date' =>time(),
                    'key'=>$_POST['key'],
                    'meta'=>$_POST['meta'],
                    'news_menu'=>$_POST['parent'],
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
                        $data_insert['news_images'] = 'thumb_'.$file_info['file_name'];
                        
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
                $this->news_model->add($data_insert);
                redirect(base_url()."admin/news");
			}
        }else{
            $this->load->view('layout', $data);   
        }
    }
    public function edit(){
        $id = $this->uri->segment(4);
        $data['info'] = $this->news_model->list_edit($id);
        $data['menuproduct'] = $this->menunews_model->fetchAll();
        $data['title'] = "Sửa bài viết";
        $data['template'] ="news/edit";
        if(isset($_POST['btnadd'])){
            $this->form_validation->set_rules("news_name","Tên bài viết","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("news_author","Tên người đăng bài","trim|required|xss_clean");
            $this->form_validation->set_rules("parent","Thuộc danh mục","required|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","numeric|xss_clean");
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
                $data['template'] = 'news/edit';
				$this->load->view("layout",$data);	
			}else{
                $data_insert = array(
                    'news_name'=>$_POST['news_name'],
                    'news_author'=>$_POST['news_author'],
                    'news_desc'=>$_POST['desc'],
                    'news_full'=>$_POST['detail'],
                    'created_by'=>$_SESSION['id'],
                    'modified_by'=>$_SESSION['id'],
                    'news_active'=>$_POST['active'],
                    'news_order'=>$_POST['porder'],
                    'news_date' =>time(),
                    'key'=>$_POST['key'],
                    'meta'=>$_POST['meta'],
                    'news_menu'=>$_POST['parent'],
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
                        $data_insert['news_images'] = 'thumb_'.$file_info['file_name'];
                        
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
                $this->news_model->update($data_insert,$id);
                redirect(base_url()."admin/news/index");
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
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }       
        $check = $this->news_model->check_name($this->input->post('news_name'),$id);
        if($check == 0){
            return true;
        }else{
            return false;
        }
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