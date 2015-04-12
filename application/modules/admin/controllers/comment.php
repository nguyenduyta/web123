<?php 
/**
*  Class Course
*  Author: HTKHOI
*  Date: 19/12/2014
*/
class comment extends CI_Controller
{
	  public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("comment_model");
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

    	$data['course']   = $this->comment_model->getAllComment($params);
      $data['title'] 		= "Danh sách comment";
    	$data['template']	= "comment/index";
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
                $commentInfo = $this->getFormData();
                $file = $this->_upload();
                if($file) {
                    $commentInfo['comment_image'] = $file;
                } else {
                    $commentInfo['comment_image'] = "/uploads/suntech/no_avatar.jpg";
                }
                $this->comment_model->insertOrUpdate($commentInfo);
                redirect(base_url('admin/comment'));
            }
        }
        $data['title']    = "Thêm Comment";
        $data['template'] = "comment/form";
        $this->load->view("layout",$data);
    }

    public function update()
    {
        $id = $this->request->getParam('id');
        $data['commentInfo'] = $this->comment_model->getOnce($id);

        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $this->validationForm();
            if($this->form_validation->run()){
                $commentInfo = $this->getFormData();
                $file = $this->_upload();
                
                if($file) {
                    $commentInfo['comment_image'] = $file;
                }

                $this->comment_model->insertOrUpdate($commentInfo,$id);
                redirect(base_url('admin/comment'));
            }
        }
        
        $data['title']    = "Sửa comment";
        $data['template'] = "comment/form";
        $this->load->view("layout",$data);
    }

    private function validationForm()
    {
      $this->form_validation->set_rules("comment_author","Fullname","trim|required|xss_clean");
      $this->form_validation->set_rules("comment_phone","Phone","trim|required|xss_clean");
      $this->form_validation->set_rules("comment_email","Email","trim|required|xss_clean");
      $this->form_validation->set_rules("comment_content","Nội dung","trim|required|xss_clean");
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
        return $dataInsert = array(
                          "comment_content"        => $this->input->post('comment_content'),
                          "comment_author"         => $this->input->post('comment_author'),
                          "comment_phone"          => $this->input->post('comment_phone'),
                          "comment_email"          => $this->input->post('comment_email'),
                          "comment_status"         => $this->input->post('comment_status'),
                          "meta_desc"              => $this->input->post('meta_desc'),
                          "meta_keyword"           => $this->input->post('meta_keyword')
                      );
    }
    /**
   * Upload Main Images Product
   * Enter description here ...
   */
  private function _upload() 
  {
    $flag = true;
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != null ) {
      $config['upload_path']   = "./uploads/suntech";
            $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
            $config['max_size']    = '50000';
            $config['max_width']   = '50024';
            $config['max_height']    = '50000';
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('image')) {
              $data['errors'] = $this->upload->display_errors("<p></p>");
              $flag = false;
            } else {
               $file_info = $this->upload->data();
               return "/uploads/suntech/".$file_info['file_name'];
            }
    } else {
      $flag = false;
    }
      return $flag; 
  }
}
