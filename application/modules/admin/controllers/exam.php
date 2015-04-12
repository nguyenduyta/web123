<?php 
/**
*  Class Course
*  Author: HTKHOI
*  Date: 17/03/2014
*/
class exam extends Admin_Controller
{
  public function __construct()
  {
      parent::__construct();
      $this->load->model("exam_model");
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
      $examList = $this->exam_model->getAll();

      $data['examList'] = $examList;
      $data['title'] 		= "Danh sách các bài thi";
    	$data['template']	= "exam/list";
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
                $formData = $this->getFormData();
                $dateForm = $this->getDate();
                $formData['enable_date']  = $dateForm['start_time'];
                $formData['disable_date'] = $dateForm['end_time'];
                $this->exam_model->insertOrUpdate($formData);
                redirect(base_url('admin/exam'));
            }
        }

        $data['title']    = "Thêm bài thi";
        $data['template'] = "exam/form";
        $this->load->view("layout",$data);
    }

    public function update($id = "")
    {
        $id = (int)$id;
        if(!$id || count($this->exam_model->getOnce($id)) <= 0) redirect("/admin/exam");

        //Check Form
        if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $this->validationForm();
            if($this->form_validation->run()) {
                $formData = $this->getFormData();
                $this->exam_model->insertOrUpdate($formData,$id);
            }
        }
        //get infomation to view
        $data['infoExam'] = $this->exam_model->getOnce($id);
        $data['title']    = "Cập nhật thông tin đề thi";
        $data['template'] = "exam/form";
        $this->load->view("layout",$data);
    }

    private function validationForm()
    {
        $this->form_validation->set_rules("name","Tên bài thi","trim|required|xss_clean");
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
                          "name"        => $params['name'],
                          "info_desc"   => $params['info_desc'],
                          "user"        => $_SESSION['id'],
                          "enable_date" => $params['enable_date']
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
