<?php 
/**
*  Class Course
*  Author: HTKHOI
*  Date: 19/12/2014
*/
class video extends CI_Controller
{
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("video_model");
         $this->load->model("course_model");
         $this->load->model("toppic_model");
    }

    /**
     * List Course
     * @not params
     */
    public function index()
    {
    	$data 	= array();
    	//Get Params
    	$params      = $this->request->getParams();
      


    	$typeOrder   = isset($params['type']) && $params['type'] == 'asc' ?  "&type=desc" : '&type=asc';
      $page        = isset($params['page']) && $params['page'] != null  ?  "&page=".$params['page'] : '&page=1';
      $searchName  = isset($params['name']) && $params['name'] != null  ?  "&name=".$params['name'] : "";
      $searchId    = isset($params['id']) && $params['id'] != null    ?  "&id=".$params['id']   : "";

      $data['sortId']   = base_url("admin/video/index?sort=course_id$typeOrder$page$searchName$searchId");
      $data['sortName'] = base_url("admin/video/index?sort=course_name$typeOrder$page$searchName$searchId");
    	$data['course']   = $this->video_model->getAllVideo($params);
      $data['toppic']   = $this->toppic_model->fetchAll(1);
      $data['title'] 		= "Danh sách video";
    	$data['template']	= "video/index";
    	$this->load->view("layout",$data);
    }
    /**
     * Create Course new
     */
    public function create()
    {

        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1) {
            $this->validationForm();
            if($this->form_validation->run()){
                $courseInfo = $this->getFormData();
                $file = $this->_upload("video_image");
                if($file) {
                    $courseInfo['video_image'] = $file;
                }
                $this->video_model->insertOrUpdate($courseInfo);
                redirect(base_url('admin/video'));
            }
        }
        $data['toppic']   = $this->toppic_model->fetchAll();
        $data['course']   = $this->course_model->getAllCourse();
        $data['title']    = "Thêm video";
        $data['template'] = "video/form";
        $this->load->view("layout",$data);
    }

    public function update()
    {
        $id = $this->request->getParam('id');

        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $this->validationForm();
            if($this->form_validation->run()){
                $courseInfo = $this->getFormData();
                $file = $this->_upload("video_image");
                if($file) {
                    $courseInfo['video_image'] = $file;
                }
                
                $this->video_model->insertOrUpdate($courseInfo,$id);
            }
        }
        $data['toppic']   = $this->toppic_model->fetchAll();
        $data['course']   = $this->course_model->getAllCourse();
        $data['videoInfo'] = $this->video_model->getOnce($id);
        $data['title']    = "Cập nhật thông video";
        $data['template'] = "video/form";
        $this->load->view("layout",$data);
    }

    private function validationForm()
    {
      $this->form_validation->set_rules("video_name","Tên video","trim|required|xss_clean");
      $this->form_validation->set_rules("video_title","Title","trim|required|xss_clean");
      $this->form_validation->set_rules("video_url","URL","trim|required|xss_clean");
      $this->form_validation->set_rules("video_link","Link","trim|required|xss_clean");
      $this->form_validation->set_rules("meta_desc","Meta Description","required|xss_clean");

      $this->form_validation->set_message('required', '%s không được để trống');      
      $this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
      $this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
      $this->form_validation->set_message('matches', '%s không trùng nhau');
      $this->form_validation->set_message("numeric","%s phải là định dạng số");
      $this->form_validation->set_error_delimiters('<div class="error">','</div>');
    }

    /**
     * Get Data From Form
     */
    private function getFormData()
    {
        $params = $this->request->getParams();
        return $dataInsert = array(
                          "video_name"        => $params['video_name'],
                          "video_title"       => $params['video_title'],
                          "video_url"         => $params['video_url'],
                          "video_link"        => $params['video_link'],
                          "video_desc"        => $params['video_desc'],
                          "video_date"        => time(),
                          "course_id"         => (int) $params['course'],
                          "create_by"         => $_SESSION['id'],
                          "toppic_id"         => (int) $params['toppic'],
                          "meta_desc"         => $params['meta_desc'],
                          "meta_keyword"      => $params['meta_keyword']
                      );
    }
    /**
   * Upload Main Images Product
   * Enter description here ...
   */
  private function _upload($inputName = "image")
  {
    if(isset($_FILES[$inputName]['name']) && $_FILES[$inputName]['name'] != null ) {
            $config['upload_path']   = "./uploads/suntech";
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size']      = '50000';
            $config['max_width']     = '50024';
            $config['max_height']    = '50000';
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload($inputName)) {
              $data['errors'] = $this->upload->display_errors("<p></p>");
              return false;
            } else {
               $file_info = $this->upload->data();
               return "/uploads/suntech/".$file_info['file_name'];
            }
    } else {
      return false;
    }
  }
  

}
