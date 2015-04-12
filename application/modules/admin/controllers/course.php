<?php 
/**
*  Class Course
*  Author: HTKHOI
*  Date: 19/12/2014
*/
class course extends CI_Controller
{
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("course_model");
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
      $data['sortId']   = base_url("admin/course/index?sort=course_id$typeOrder$page$searchName$searchId");
      $data['sortName'] = base_url("admin/course/index?sort=course_name$typeOrder$page$searchName$searchId");
    	$data['course']   = $this->course_model->getAllCourse($params);
      $data['title'] 		= "Danh sách các khóa học";
    	$data['template']	= "course/index";
    	$this->load->view("layout",$data);
    }
    /**
     * Create Course new
     */
    public function create()
    {

        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $this->validationForm();
            if($this->form_validation->run()){
                $courseInfo = $this->getFormData();
                $file = $this->_upload();
                if($file) {
                    $courseInfo['course_image'] = $file;
                }

                $iconFile = $this->_upload('icon_course');
                if($iconFile) {
                    $courseInfo['course_icon_image'] = $iconFile; 
                }

                $this->course_model->insertOrUpdate($courseInfo);
                redirect(base_url('admin/course'));
            }
        }
        $data['title']    = "Thêm khóa học";
        $data['template'] = "course/form";
        $this->load->view("layout",$data);
    }

    public function update()
    {
        $id = $this->request->getParam('id');
        $data['courseInfo'] = $this->course_model->getOnce($id);

        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $this->validationForm();
            if($this->form_validation->run()){
                $courseInfo = $this->getFormData();
                $file = $this->_upload();
                if($file) {
                    $courseInfo['course_image'] = $file;
                }
                $iconFile = $this->_upload('icon_course');
                if($iconFile) {
                    $courseInfo['course_icon_image'] = $iconFile; 
                }
                
                $this->course_model->insertOrUpdate($courseInfo,$id);
                
            }
        }

        $data['title']    = "Cập nhật thông tin khóa học";
        $data['template'] = "course/form";
        $this->load->view("layout",$data);
    }

    private function validationForm()
    {
      $this->form_validation->set_rules("course_name","Tên khóa học","trim|required|xss_clean");
      $this->form_validation->set_rules("course_title","Title","trim|required|xss_clean");
      $this->form_validation->set_rules("course_url","URL","trim|required|xss_clean");
      $this->form_validation->set_rules("course_author","Author","trim|required|xss_clean");
      $this->form_validation->set_rules("course_price","Fee","trim|required|xss_clean");
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
                          "course_name"       => $params['course_name'],
                          "course_title"      => $params['course_title'],
                          "course_url"        => $params['course_url'],
                          "course_author"     => $params['course_author'],
                          "course_price"      => $params['course_price'],
                          "course_sale"       => $params['course_sale'],
                          "course_time"       => $params['course_time'],
                          "course_desc"       => $params['course_desc'],
                          "course_you"        => $params['course_you'],
                          "course_object"     => $params['course_object'],
                          "course_event"      => $params['course_event'],
                          "course_status"     => $params['status'],
                          "course_detail"     => $params['course_detail'],
                          "course_promotion"  => $params['course_promotion'],
                          "course_order"      => $params['course_order'],
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
