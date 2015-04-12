<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class tuts extends CI_Controller {
	public function __construct() 
    {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model('tuts_model');
         $this->load->model('course_model');
         $this->load->model('toppic_model');
         $this->load->model('project_model');
         $this->load->model('user_model');
    }

    public function index()
    {
        $params = $this->request->getParams();
        $total   = $this->tuts_model->totalRow($params);
        $searchName   = isset($params['news_name']) && $params['news_name'] != null ? "&news_name=".$params['news_name'] : "";
        $searchToppic = isset($params['toppic']) && $params['toppic'] != null ? "&toppic=".$params['toppic'] : "";
        $searchCourse = isset($params['course']) && $params['course'] != null ? "&course=".$params['course'] : "";
        $searchUser   = isset($params['user']) && $params['user'] != null ? "&user=".$params['user'] : "";

        if($total > 0) {
            $this->load->library('pagination');
            $config['base_url']     = base_url("admin/tuts/index?$searchName$searchUser$searchCourse$searchToppic ");
            $config['total_rows']   =  $total;
            $config['per_page']     = 15;
            $config['first_link']   = 'First' ;
            $config['last_link']    = 'Last' ;
            $config['page_query_string'] = true;
            $this->pagination->initialize($config);
            $limit = 10;
            $start = isset($params['per_page']) && $params['per_page'] != null ? $params['per_page'] : 0;
            $data['tuts']   = $tuts = $this->tuts_model->getAll($limit,$start,$params);
        } else {
            $data['tuts']   = null;
        }
        $data['course']     = $this->course_model->getAllCourse();
        $data['toppic']     = $this->toppic_model->fetchAll();
        $data['user']       = $this->user_model->getAll();

        $data['title']      = 'Danh sách Tuts';
        $data['page']       = $this->uri->segment(4);
        $data['template']   = 'tuts/default';
        $this->load->view('layout', $data);
        
    }
    /**
     * Insert Tuts
     */
    public function add()
    {
        if(isset($_POST['btnadd'])) {
            $this->validationForm();
			//Kiem tra
			if($this->form_validation->run()) {
                $data_insert = $this->getForm();
                $fileUpload = $this->_upload();
                if($fileUpload) {
                    $data_insert['news_images'] = $fileUpload;
                }
                $this->tuts_model->add($data_insert);
                redirect(base_url()."admin/tuts");
			}
        }
        $data['project'] = $this->project_model->getAllProject();
        $data['course']      = $this->course_model->getAllCourse();
        $data['menuproduct'] = $this->toppic_model->fetchAll();
        $data['title']       = 'Thêm Tuts mới';
        $data['template']    = 'tuts/add';
        $this->load->view("layout",$data);
    }

    public function validationForm()
    {
            $this->form_validation->set_rules("news_name","Tuts name","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("news_title","Title","trim|required|xss_clean");
            $this->form_validation->set_rules("news_url","URL","required|xss_clean");
            $this->form_validation->set_rules("width","Chiều rộng","numeric|xss_clean");
            $this->form_validation->set_rules("height","Chiều cao","numeric|xss_clean");
            $this->form_validation->set_rules("meta","Meta Description","required|xss_clean");

            $this->form_validation->set_message('required', '%s không được để trống');          
            $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
            $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
            $this->form_validation->set_message('matches', '%s không trùng nhau');
            $this->form_validation->set_message("valid_email","%s không đúng định dạng");
            $this->form_validation->set_message("numeric","%s phải là định dạng số");
            $this->form_validation->set_message("check_name","Tên bài viết đã tồn tại. Hãy chọn tên khác");
            $this->form_validation->set_error_delimiters('<div class="error">','</div>');
    }

    public function getForm()
    {
        return array(
                    'news_name'     => $this->input->post('news_name'),
                    'news_title'    => $this->input->post('news_title'),
                    'news_url'      => $this->input->post('news_url'),
                    'news_desc'     => $this->input->post('desc'),
                    'news_full'     => $this->input->post('detail'),
                    'created_by'    => $_SESSION['id'],
                    'modified_by'   => $_SESSION['id'],
                    'news_active'   => $this->input->post('active'),
                    'news_order'    => $this->input->post('porder'),
                    'news_date'     => time(),
                    'meta_keyword'  => $this->input->post('key'),
                    'meta_desc'     => $this->input->post('meta'),
                    'toppic_id'     => $this->input->post('parent'),
                    'course_id'     => $this->input->post('course'),
                    'project_id'    => $this->input->post('project'),
                    'news_share'    => $this->input->post('news_share')
                );
    }

    private function _upload()
    {
        $flag = "";
        if($_FILES['img']['name'] != "") {
                    $config['upload_path'] = './uploads/tuts/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg';
                    $config['max_size'] = '2000';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '1000';
                    $this->load->library('upload', $config);
                    
                    if(!$this->upload->do_upload('img')){
                        $data['errors'] = $this->upload->display_errors("<p></p>");
                        $data['template'] = 'tuts/add';
                        $this->load->view("layout",$data);
                    } else {
                        $file_info = $this->upload->data();

                        $config = array(
                            "source_image" =>"./uploads/tuts/".$file_info['file_name'],
                            "new_image" =>"./uploads/tuts/thumbs/",
                            "create_thumb"=> TRUE,
                            "maintain_ration" =>TRUE,
                            "width" =>180,
                            "height" =>180,
                        );
                        $this->load->library("image_lib",$config);
                          if(!$this->image_lib->resize()){
                            $data['errors'] = $this->image_lib->display_errors();
                          }else{
                             $this->image_lib->resize();
                          }
                        $flag = '/uploads/tuts/thumbs/thumb_'.$file_info['file_name'];
                    }
            }
            return $flag;
    }

    public function edit() 
    {
        $id = $this->uri->segment(4);   
        if(isset($_POST['btnadd'])){
            $this->validationForm();
			//Kiem tra
			if($this->form_validation->run()) {
                $data_insert = $this->getForm();
                $fileUpload = $this->_upload();
                if($fileUpload) {
                    $data_insert['news_images'] = $fileUpload;
                }
                $this->tuts_model->update($data_insert,$id);
                //redirect(base_url()."admin/tuts/index");
            }
        }
        $data['menuproduct'] = $this->toppic_model->fetchAll();
        $data['project'] = $this->project_model->getAllProject();
        $data['course']      = $this->course_model->getAllCourse();
        $data['info']     = $this->tuts_model->list_edit($id);
        $data['title']    = "Sửa tuts";
        $data['template'] ="tuts/edit";
        $this->load->view('layout', $data);   
    }

    public function delete() {
        $id = $this->uri->segment(4);        
        $this->tuts_model->delete($id);
        redirect(base_url('admin/tuts'), 'refresh');    
	}
}