<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class acount extends CI_Controller {
	public function __construct() {
         session_start();   
      	 parent::__construct();
      	 if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
         $this->load->model("user_model");
    }
    public function index()
    {
        $data['active'] = $this->uri->segment(3);
        $data['title'] = 'Thay đổi mật khẩu quản trị';
        $data['template'] = 'acount/changepassword';
        if(isset($_POST['isSubmit'])){
            $this->form_validation->set_rules("oldpass","Mật khẩu hiện tại","trim|required|min_length[6]|callback_check_pass|xss_clean");
			$this->form_validation->set_rules("reoldpass","Mật khẩu nhập lại","trim|required|matches[oldpass]|xss_clean");
			$this->form_validation->set_rules("newpass","Mật khẩu mới","trim|required|min_length[6]|xss_clean");
			$this->form_validation->set_rules("renewpass","Mật khẩu nhập lại","trim|required|matches[newpass]|xss_clean");
            
			//$this->form_validation->set_rules("address","Địa chỉ","trim|required");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d ký tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d ký tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_pass","Mật khẩu hiện tại không đúng");
			$this->form_validation->set_message("check_email","Email này đã tồn tại");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			
			//Kiem tra
			if($this->form_validation->run()==FALSE){
				$this->load->view("layout",$data);	
			}else{
			     $data_update = array(
                   "password" =>md5($_POST['newpass']),
                 );
                 $this->user_model->change_password($data_update);
                 $data['alert'] = "Chúc mừng bạn thay đổi thông tin thành công";
                 $this->load->view('layout', $data);   
			}                            
        }else{
            $this->load->view('layout', $data);   
        }
    }

    public function acount_info()
    {
        $data['title'] = "Thông tin tài khoản quản trị";
        $data['template'] ="acount/acountinfo";
        $data['info'] = $this->user_model->info_user($_SESSION['admin']);
        if(isset($_POST['isSubmit']))
        {
            $this->form_validation->set_rules("fullname","Tên đầy đủ","trim|required|xss_clean");
			$this->form_validation->set_rules("email","Mật khẩu nhập lại","trim|required|xss_clean");
            
			//$this->form_validation->set_rules("address","Địa chỉ","trim|required");
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d ký tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d ký tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_pass","Mật khẩu hiện tại không đúng");
			$this->form_validation->set_message("check_email","Email này đã tồn tại");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			
			//Kiem tra
			if($this->form_validation->run()==FALSE){
				$this->load->view("layout",$data);	
			}else{
                $data_update = array(
                    "fullname"=>$_POST['fullname'],
                    "user_email"=>$_POST['email'],
                );
                 $this->user_model->change_password($data_update);
                 $data['info'] = $this->user_model->info_user($_SESSION['admin']);
                 $data['alert'] = "Chúc mừng bạn cập nhật thông tin thành công";
                 $this->load->view('layout', $data);   
                
			}                            
        }else{
        $this->load->view('layout', $data);
        }
    }
    public function check_pass(){
        $check = $this->user_model->check_password($_SESSION['admin'],$_POST['oldpass']);
        if(count($check) > 0 ){
            return true;
        }else{
            return false;
        }
    }
}
