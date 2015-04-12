<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adsposition extends CI_Controller {
	public function __construct()
    {
		parent::__construct();
        $this->load->model('adsposition_model');
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    
    public function index() {
        $data['title'] = 'Vị trí đặt quảng cáo';
        $data['adsposition'] = $this->adsposition_model->fetchAll();
        $data['template'] = 'adsposition/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        $data['title'] = 'Thêm vị trí đặt quảng cáo';
            if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("posname","Vị trí đặt quảng cáo","trim|required|callback_check_name|xss_clean");
			$this->form_validation->set_rules("posorder","Thứ tự xắp xếp","trim|numeric|xss_clean");
            
           
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("valid_email","%s không đúng định dạng");
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên vị trí đã tồn tại. Hãy chọn vị trí khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');

			if($this->form_validation->run()==FALSE){
                $data['template'] = 'adsposition/add';
				$this->load->view("layout",$data);	
			}else{
				$dataAdd = array(
					'posname'      =>  $this->input->post('posname'),
					'posorder'     =>  $this->input->post('posorder'),
					'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'date'         =>  mktime(),
                    'posactive'    =>  $this->input->post('posactive')
				);

				$this->adsposition_model->add($dataAdd);
				redirect(base_url('admin/adsposition'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "adsposition/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit() {
        $data['title'] = 'Sửa vị trí đặt quảng cáo';
        $data['template'] = 'adsposition/add';
        $this->load->view('layout', $data);
    }
    
    public function delete() {

    }
    
    public function sort() {
        
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
                $data = array('posactive'=>1);
				$this->adsposition_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('posactive'=>0);
				$this->adsposition_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/adsposition'), 'location');
		}
    }
    
    public function check_name() {
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->adsposition_model->check_name($this->input->post('posname'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

