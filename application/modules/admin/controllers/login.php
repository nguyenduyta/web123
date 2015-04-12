<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	public function __construct() {
        session_start();
		parent::__construct();
        $this->load->model("user_model");
    }
    public function index(){
        $data = array();
        if(isset($_POST['btnlogin'])){
            if($_POST['username'] == "" || $_POST['password'] == ""){
                $data['errors'] = "Vui lòng nhập đủ thông tin";
                $this->load->view("login/default",$data);
                return false;
            }
            $check = $this->user_model->check_login($_POST['username'],$_POST['password']);
           
            if(count($check) > 1){
                if(isset($_POST['remember'])){
                    $_SESSION['re_name'] = $_SESSION['re_pass'] =""; 
                    $_SESSION['re_name'] = $_POST['username'];
                    $_SESSION['re_pass'] = $_POST['password']; 
                }else{
                    unset($_SESSION['re_name']);
                    unset($_SESSION['re_pass']);
                }
                $_SESSION['admin'] =$check['user_name'];
                $_SESSION['id'] = $check['user_id'];
                $_SESSION['level'] = $check['user_level'];
                $group = $this->user_model->getGroup($check['user_level']);
                $_SESSION['permission'] = $group['permission'];
                redirect(base_url()."admin/index");
            }else{
                $data['errors'] = "Sai tên đăng nhập hoặc mật khẩu";
                $this->load->view("login/default",$data);
                return false;
            }
        }else{
            $this->load->view("login/default",$data);
        }
    }
    public function logout(){
        unset($_SESSION['admin']);
        redirect(base_url()."admin/login");
        
    }
}

