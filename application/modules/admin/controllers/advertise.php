<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class advertise extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('adsposition_model');
        $this->load->model('advertise_model');
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
			$this->advertise_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index(){
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'advertise_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Danh sách khách hàng';
        $data['advertise'] = $this->advertise_model->fetchAll();
        $data['template'] = 'advertise/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'advertise_add')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $data['title'] = 'Thêm khách hàng';
        $data['adsposition'] = $this->adsposition_model->fetchAll();
            if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("adsname","Tên khách hàng","trim|required|callback_check_name|xss_clean");
    			$this->form_validation->set_rules("adsfile","Hình ảnh","trim|required|max_length[255]|xss_clean");
                $this->form_validation->set_rules("adsorder","Thứ tự xắp xếp","trim|numeric|xss_clean");
                $this->form_validation->set_rules("width","Chiều rộng","trim|numeric|xss_clean");
                $this->form_validation->set_rules("height","Chiều cao","trim|numeric|xss_clean");
                
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tiêu đề quảng cáo đã tồn tại. Hãy chọn tiêu đề khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'advertise/add';
    				$this->load->view("layout",$data);	
    			}else{
		            if($this->input->post('width')) {
		              $width = $this->input->post('width');
		            } else {
		              //Default value width
		              $width = 188;
		            }
                    
		            if($this->input->post('height')) {
		              $height = $this->input->post('height');
		            } else {
		              //Default value height
		              $height = 124;
		            }
    				$dataAdd = array(
                        'adsposition'  =>  $this->input->post('adsposition'),
                        'adstype'      =>  $this->input->post('adstype'),
                        'open'         =>  $this->input->post('open'),
    					'adsname'      =>  $this->input->post('adsname'),
    					'adsfile'      =>  $this->input->post('adsfile'),
    					'adsorder'     =>  $this->input->post('adsorder'),
                        'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'width'        =>  $width,
                        'height'       =>  $height,
                        'date'         =>  mktime(),
                        'adslink'      =>  $this->input->post('adslink'),
                        'adsactive'    =>  $this->input->post('adsactive')
    				);
    
    				$this->advertise_model->add($dataAdd);
    				redirect(base_url('admin/advertise'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "advertise/add";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    public function edit() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'advertise_edit')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $segment4 = (int)$this->uri->segment(4);
        $data['title'] = 'Thay đổi hình ảnh quảng cáo';
        $data['adsposition'] = $this->adsposition_model->fetchAll();
        $data['advertise'] = $this->advertise_model->fetchOne($segment4);
            if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
    			$this->form_validation->set_rules("adsname","Tiêu đề quảng cáo","trim|required|callback_check_name|xss_clean");
    			$this->form_validation->set_rules("adsfile","File quảng cáo","trim|required|max_length[255]|xss_clean");
                $this->form_validation->set_rules("adsorder","Thứ tự xắp xếp","trim|numeric|xss_clean");
                $this->form_validation->set_rules("width","Chiều rộng","trim|numeric|xss_clean");
                $this->form_validation->set_rules("height","Chiều cao","trim|numeric|xss_clean");
                
    			$this->form_validation->set_message('required', '%s không được để trống');			
    			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
    			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
    			$this->form_validation->set_message('matches', '%s không trùng nhau');
    			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
    			$this->form_validation->set_message("numeric","%s phải là định dạng số");
    			$this->form_validation->set_message("check_name","Tiêu đề quảng cáo đã tồn tại. Hãy chọn tiêu đề khác");
    			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
    
    			if($this->form_validation->run()==FALSE){
                    $data['template'] = 'advertise/add';
    				$this->load->view("layout",$data);	
    			}else{
		            if($this->input->post('width')) {
		              $width = $this->input->post('width');
		            } else {
		              //Default value width
		              $width = 188;
		            }
                    
		            if($this->input->post('height')) {
		              $height = $this->input->post('height');
		            } else {
		              //Default value height
		              $height = 124;
		            }
    				$dataEdit = array(
                        'adsposition'  =>  $this->input->post('adsposition'),
                        'adstype'      =>  $this->input->post('adstype'),
                        'open'         =>  $this->input->post('open'),
    					'adsname'      =>  $this->input->post('adsname'),
    					'adsfile'      =>  $this->input->post('adsfile'),
    					'adsorder'     =>  $this->input->post('adsorder'),
                        'created_by'   =>  $_SESSION['id'],
                        'modified_by'  =>  $_SESSION['id'],
                        'width'        =>  $width,
                        'height'       =>  $height,
                        'date'         =>  mktime(),
                        'adslink'      =>  $this->input->post('adslink'),
                        'adsactive'    =>  $this->input->post('adsactive')
    				);
    
    				$this->advertise_model->update($segment4, $dataEdit);
    				redirect(base_url('admin/advertise'), 'location');
    			}
    		//Load view
    		}else{
                $data['template'] = "advertise/edit";
    			$this->load->view("layout",$data);	 
    		}
    }
    
    public function delete() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'advertise_delete')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
        $id = $this->uri->segment(4);        
        $this->advertise_model->delete($id);
        redirect(base_url('admin/advertise'), 'refresh');    
    }
    
    public function search() {
        $keyword = $this->input->post('keyword');
        $data['title'] = 'Kết quả tìm kiếm';
        $sql = "SELECT *
                FROM tbl_advertise 
                INNER JOIN tbl_user
                ON tbl_advertise.created_by = tbl_user.user_id
                INNER JOIN tbl_position
                ON tbl_advertise.adsposition = tbl_position.id
                WHERE adsname 
                LIKE '%".$keyword."%'
                ORDER BY tbl_advertise.id ASC";
        $result = $this->advertise_model->query($sql);
        $data['advertise'] = $result;
        $data['template'] = "advertise/search";
		$this->load->view("layout",$data);	 
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
                $data = array('adsactive'=>1);
				$this->advertise_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('adsactive'=>0);
				$this->advertise_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/advertise'), 'location');
		}
    }
    
    public function check_name() {
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->advertise_model->check_name($this->input->post('adsname'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}



