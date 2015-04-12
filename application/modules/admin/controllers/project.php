<?php 
/**
*  Class Course
*  Author: HTKHOI
*  Date: 19/12/2014
*/
class project extends CI_Controller
{
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("project_model");
    }

    /**
     * List Course
     * @not params
     */
    public function index()
    {
    	$data['project']  = $this->project_model->getAllProject();
      $data['title'] 		= "Danh sách Project";
    	$data['template']	= "project/index";
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
                $projectInfo = $this->getFormData();
                $file = $this->_upload();
                if($file) {
                    $projectInfo['project_image'] = $file;
                }

                $this->project_model->insertOrUpdate($projectInfo);
                redirect(base_url('admin/project'));
            }
        }
        $data['title']    = "Thêm project";
        $data['template'] = "project/form";
        $this->load->view("layout",$data);
    }

    public function update()
    {
        $id = $this->request->getParam('id');
        $data['projectInfo'] = $this->project_model->getOnce($id);

        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1) {
            $this->validationForm();
            if($this->form_validation->run()){
                $projectInfo = $this->getFormData();
                $file = $this->_upload();
                if($file) {
                    $projectInfo['project_image'] = $file;
                }
                $this->project_model->insertOrUpdate($projectInfo,$id);
                redirect(base_url('admin/project'));
            }
        }

        $data['title']    = "Cập nhật thông tin Prject";
        $data['template'] = "project/form";
        $this->load->view("layout",$data);
    }

    private function validationForm()
    {
      $this->form_validation->set_rules("project_name","Tên project","trim|required|xss_clean");
      $this->form_validation->set_rules("project_title","Title","trim|required|xss_clean");
      $this->form_validation->set_rules("project_url","URL","trim|required|xss_clean");
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
                          "project_name"      => $params['project_name'],
                          "project_title"     => $params['project_title'],
                          "project_url"       => $params['project_url'],
                          "project_desc"      => $params['project_desc'],
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
