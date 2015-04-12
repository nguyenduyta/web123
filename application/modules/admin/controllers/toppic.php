<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class toppic extends CI_Controller
{

	public function __construct() {
		parent::__construct();
        $this->load->model('toppic_model');
        $this->load->model('news_model');
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
   	    }
    }
    public function index(){
        $data['title'] = 'Danh sách Toppic';
        $data['menunews'] = $this->toppic_model->fetchAll();
        $data['template'] = 'toppic/default';
        $this->load->view('layout', $data);
    }
    public function add()
    {
        $data['menuproduct'] = $this->toppic_model->fetchAll();

		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1) {
			$this->setValidation();
			//Kiem tra
			if($this->form_validation->run()) 
            {
				$dataAdd = $this->getFormData();
                $dataAdd['images'] = $this->upload();
				$this->toppic_model->add($dataAdd);
				redirect(base_url('admin/toppic'), 'location');
			}
		//Load view
		}

        $data['title'] = "Thêm Toppic";
        $data['template'] = "toppic/add";
		$this->load->view("layout",$data);	 
		
 	}

    public function setValidation()
    {
        $this->form_validation->set_rules("name","Tên Toppic","trim|required");
        $this->form_validation->set_rules("order","Thứ tự xắp xếp","trim|numeric|xss_clean");
        $this->form_validation->set_rules("parent","Thuộc danh mục","required|xss_clean");
        $this->form_validation->set_rules("width","Chiều rộng","numeric|xss_clean");
        $this->form_validation->set_rules("height","Chiều cao","numeric|xss_clean");
        $this->form_validation->set_rules("meta_desc","Meta desciption","required|xss_clean");
        $this->form_validation->set_rules("title","Title","required|xss_clean");
        $this->form_validation->set_rules("url","URL","required|xss_clean");

        $this->form_validation->set_message('required', '%s không được để trống');          
        $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
        $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
        $this->form_validation->set_message('matches', '%s không trùng nhau');
        $this->form_validation->set_message("valid_email","%s không đúng định dạng");
        $this->form_validation->set_message("numeric","%s phải là định dạng số");
        $this->form_validation->set_error_delimiters('<div class="error">','</div>');
    }

    private function upload()
    {
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1)
        //Upload image
            if($_FILES['image']['name'] != NULL) {
                
                $image_path = './uploads/news/menu/';
                $config['upload_path'] = $image_path;
                $config['allowed_types'] = 'jpg|gif|png|jpeg';
                $config['max_size'] = '30000';
                $config['max_width']  = '20000';
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
                    $flag = false;
                } else {
                        $file_infor = $this->upload->data();
                        $image = $file_infor['file_name'];        
                        //resize imgage
                        $width  = $_POST['width'];
                        $height = $_POST['height'];
                        $this->toppic_model->resizeImage($image_path, $image, $width, $height);
                        //end resize image
                        return "/uploads/news/menu/thumb_".$image; 
                }
            } else {
                return "";
            }
    }
    /**
     * Get Form Data
     */
    private function getFormData()
    {
        return array(
                    'name'         =>  $this->input->post('name'),
                    'title'        =>  $this->input->post('title'),
                    'url'          =>  $this->input->post('url'),
                    'info'         =>  $this->input->post('desciption'),
                    'parent'       =>  $this->input->post('parent'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'order'        =>  $this->input->post('order'),
                    'meta_desc'    =>  $this->input->post('meta_desc'),
                    'meta_keyword' =>  $this->input->post('meta_keyword'),
                    'option'       =>  '',
                    'active'       =>  $this->input->post('active'),
                    'date'         =>  mktime()
                );
    }


    public function edit() 
    {
        $id = (int)$this->uri->segment(4);
        $data['menunews'] = $this->toppic_model->fetchAll();

        if(isset($_POST['btnAdd'])){
			$this->setValidation();
			//Kiem tra
    	    if($this->form_validation->run()) {
                    $dataEdit = $this->getFormData();
					$dataAdd['images'] = $this->upload();
                    $this->toppic_model->update($id,$dataEdit);
            }
        }
        $data['info'] = $this->toppic_model->info_edit($id);
        $data['title'] = "Sửa Toppic";
        $data['template']="toppic/edit";
        $this->load->view('layout',$data);
    }

    /**
     * Delete Toppic
     */
    public function delete()
    {
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
