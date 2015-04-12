<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends CI_Controller {
	public function __construct() {
		parent::__construct();
        $this->load->model('product_model');
        $this->load->model('menuproduct_model');
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
        $this->load->model('brand_model');
   	    if($this->input->post('cid') && is_array($this->input->post('cid')) && count($this->input->post('cid')) > 0) {
			$idGroup = $this->input->post('cid');
			$listIdGroup = implode(',', $idGroup);
            //Delete Image
            $query = "SELECT pimage1, pimage2, pimage3, pimage4, pimage5 
                      FROM tbl_product 
                      WHERE id IN (".$listIdGroup.")";
            $product = $this->product_model->queryProduct($query);
            foreach($product as $key=>$val) {
                if($val['pimage1'] != 'no-image.png' && $val['pimage1'] != '') {
                    @unlink('uploads/product/product/'.$val['pimage1']);
                    @unlink('uploads/product/product/thumb_'.$val['pimage1']);
                }
                
                if($val['pimage2'] != 'no-image.png' && $val['pimage2'] != '') {
                    @unlink('uploads/product/product/'.$val['pimage2']);
                    @unlink('uploads/product/product/thumb_'.$val['pimage2']);
                }
                
                if($val['pimage3'] != 'no-image.png' && $val['pimage3'] != '') {
                    @unlink('uploads/product/product/'.$val['pimage3']);
                    @unlink('uploads/product/product/thumb_'.$val['pimage3']);
                }
                
                if($val['pimage4'] != 'no-image.png' && $val['pimage4'] != '') {
                    @unlink('uploads/product/product/'.$val['pimage4']);
                    @unlink('uploads/product/product/thumb_'.$val['pimage4']);
                }
                
                if($val['pimage5'] != 'no-image.png' && $val['pimage5'] != '') {
                    @unlink('uploads/product/product/'.$val['pimage5']);
                    @unlink('uploads/product/product/thumb_'.$val['pimage5']);
                }
            }
            //End Delete Image
			$this->product_model->delete($idGroup, 'id');
			redirect(base_url().trim(uri_string(), '/'), 'location');
		}
    }
    
    public function index() {
        $data['title'] = 'Danh sách khóa học';
        $query = 'SELECT *
                  FROM tbl_product
                  INNER JOIN tbl_user
                  ON tbl_user.user_id = tbl_product.created_by
                  ORDER BY id DESC';
        
        $data['product'] = $this->product_model->queryProduct($query);
        $data['template'] = 'product/default';
        $this->load->view('layout', $data);
    }
    
    public function add() {
        $data['title'] = "Thêm khóa học";
        $data['menuproduct'] = $this->menuproduct_model->fetchAll();
        $data['brand'] = $this->brand_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
			$this->form_validation->set_rules("pname","Tên khóa học","trim|required|xss_clean");
			$this->form_validation->set_rules("desc","Mô tả ngắn","required|xss_clean");
            $this->form_validation->set_rules("detail","Mô tả chi tiết","min_length[4]|max_length[20000]|xss_clean");
            $this->form_validation->set_rules("porder","Thứ tự","numeric|max_length[10]|xss_clean");
            
			$this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên sản phẩm đã tồn tại. Hãy chọn tên sản phẩm khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'product/add';
				$this->load->view("layout",$data);	
			}else{
                if($this->input->post('saleoff')) {
                    $saleoff = $this->input->post('saleoff');
                } else {
                    $saleoff = 0;
                }
                if(isset($_POST['banchay'])){
                    $banchay = $_POST['banchay'];
                }else{
                    $banchay = 0;
                }
				$dataAdd = array(
            		'pname'        =>  $this->input->post('pname'),
                    'key'        =>  $this->input->post('key'),
                    'meta'        =>  $this->input->post('meta'),
                    'desc'         =>  $this->input->post('desc'),
                    'detail'       =>  $this->input->post('detail'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'pactive'       =>  $this->input->post('active'),
                    'option'       =>  NULL,
                    'date'         =>  mktime(),
                    'porder'       =>  $this->input->post('porder'),                    
				);
				
                ///////////////////////////////Upload image
                //Upload image 1
				if($_FILES['image1']['name'] != NULL){
				    $image_path = './uploads/product/product/';
					$config['upload_path'] = $image_path;
					$config['allowed_types'] = 'jpg|gif|png|jpeg';
					$config['max_size']	= '2048';
					$config['max_width']  = '2048';
					$config['max_height']  = '2048';
					$config['encrypt_name'] = true;
					$this->load->library('upload');
                    $this->upload->initialize($config);
                    unset($config);
                    if(!$this->upload->do_upload('image1')) {
                        $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                        if($error != NULL) {
                            $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                        }
                        
                        $data['template'] = 'product/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        $file_infor = $this->upload->data();
                        $image1 = $file_infor['file_name'];
                        $dataAdd['pimage1'] = $image1;
                        
                        //resize imgage
                        $width  = 120;
                        $height = 120;
                        $this->product_model->resizeImage($image_path, $image1, $width, $height);
                        //end resize image
                    }
				} else {
				    $dataAdd['pimage1'] = 'no-image.png';
				}

				$this->product_model->add($dataAdd);
				redirect(base_url('admin/product'), 'location');
			}
		//Load view
		}else{
            $data['template'] = "product/add";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function edit() {
        $segment4 = (int)$this->uri->segment(4);
        $data['product'] = $product = $this->product_model->fetchOne($segment4);
        $data['menuproduct'] = $this->menuproduct_model->fetchAll();
        $data['brand'] = $this->brand_model->fetchAll();
		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $this->form_validation->set_rules("vat","VAT","trim|xss_clean");
			$this->form_validation->set_rules("pname","Tên khóa học","trim|required|callback_check_name|xss_clean");
            $this->form_validation->set_rules("desc","Mô tả ngắn","required|xss_clean");
            $this->form_validation->set_rules("detail","Mô tả chi tiết","xss_clean");
            $this->form_validation->set_rules("porder","Thứ tự","numeric|xss_clean");
			
            $this->form_validation->set_message('required', '%s không được để trống');			
			$this->form_validation->set_message("min_length","%s không được nhỏ hơn %d kí tự");
			$this->form_validation->set_message("max_length","%s không được lớn hơn %d kí tự");
			$this->form_validation->set_message('matches', '%s không trùng nhau');
			$this->form_validation->set_message("numeric","%s phải là định dạng số");
			$this->form_validation->set_message("check_name","Tên sản phẩm đã tồn tại. Hãy chọn tên sản phẩm khác");
			$this->form_validation->set_error_delimiters('<div class="error">','</div>');
			//Kiem tra
			if($this->form_validation->run()==FALSE){
                $data['template'] = 'product/add';
				$this->load->view("layout",$data);	
			}else{
                if($this->input->post('menu')) {
                    $menu = $this->input->post('menu');
                } else {
                    $menu = $product['menu_id'];
                }
                if(isset($_POST['banchay'])){
                    $banchay = $_POST['banchay'];
                }else{
                    $banchay = 0;
                }
				$dataEdit = array(
                   
					'pname'        =>  $this->input->post('pname'),
                    'key'        =>  $this->input->post('key'),
                    'meta'        =>  $this->input->post('meta'),
                    'desc'         =>  $this->input->post('desc'),
                    'detail'       =>  $this->input->post('detail'),
                    'created_by'   =>  $_SESSION['id'],
                    'modified_by'  =>  $_SESSION['id'],
                    'pactive'       =>  $this->input->post('active'),
                    'option'       =>  NULL,
                    'date'         =>  mktime(),
                    'porder'        =>  $this->input->post('porder'),
                    'tinhtrang'	   => $this->input->post("tinhtrang"),
				);
				
                ///////////////////////////////Upload image
                //Upload image 1
				if($_FILES['image1']['name'] != NULL){
				    $image_path = './uploads/product/product/';
					$config['upload_path'] = $image_path;
					$config['allowed_types'] = 'jpg|gif|png|jpeg';
					$config['max_size']	= '2048';
					$config['max_width']  = '2048';
					$config['max_height']  = '2048';
					$config['encrypt_name'] = true;
					$this->load->library('upload');
                    $this->upload->initialize($config);
                    unset($config);
                    if(!$this->upload->do_upload('image1')) {
                        $error = array('errors' =>$this->upload->display_errors("File không đúng định dạng"));
                        if($error != NULL) {
                            $data['errors'] = "File không hợp lệ. Hãy kiểm tra lại";
                        }
                        
                        $data['template'] = 'product/add';
                        $this->load->view('layout', $data);
                        return false;
                    } else {
                        if($product['pimage1'] != 'no-image.png') {
                            @unlink('uploads/product/product/'.$product['pimage1']);
                            @unlink('uploads/product/product/thumb_'.$product['pimage1']); 
                        }
                        $file_infor = $this->upload->data();
                        $image1 = $file_infor['file_name'];
                        $dataEdit['pimage1'] = $image1;
                        
                        //resize imgage
                        $width  = 150;
                        $height = 170;
                        $this->product_model->resizeImage($image_path, $image1, $width, $height);
                        //end resize image
                    }
				} else {
				    $dataEdit['pimage1'] = $product['pimage1'];
				}
                //////////////////////////////End upload image
				$this->product_model->update($segment4, $dataEdit);
				redirect(base_url('admin/product'), 'location');
			}
		//Load view
		}else{
             $data['title'] = "Cập nhật thông tin khóa học";
            $data['template'] = "product/edit";
			$this->load->view("layout",$data);	 
		}
    }
    
    public function delete(){
        
        $id = $this->uri->segment(4);
        $product = $this->product_model->fetchOne($id);
        if($product['pimage1'] != 'no-image.png' && $product['pimage1'] != '') {
            @unlink('uploads/product/product/'.$product['pimage1']);
            @unlink('uploads/product/product/thumb_'.$product['pimage1']);
        }
        if($product['pimage2'] != 'no-image.png' && $product['pimage2'] != '') {
            @unlink('uploads/product/product/'.$product['pimage2']);
            @unlink('uploads/product/product/thumb_'.$product['pimage2']);
        }
        if($product['pimage3'] != 'no-image.png' && $product['pimage3'] != '') {
            @unlink('uploads/product/product/'.$product['pimage3']);
            @unlink('uploads/product/product/thumb_'.$product['pimage3']);
        }
        if($product['pimage4'] != 'no-image.png' && $product['pimage4'] != '') {
            @unlink('uploads/product/product/'.$product['pimage4']);
            @unlink('uploads/product/product/thumb_'.$product['pimage4']);
        }
        if($product['pimage5'] != 'no-image.png' && $product['pimage5'] != '') {
            @unlink('uploads/product/product/'.$product['pimage5']);
            @unlink('uploads/product/product/thumb_'.$product['pimage5']);
        }        
        $this->product_model->delete($id);
        redirect(base_url('admin/product'), 'refresh');    
    }
    
    
    public function search() {
        $data['title'] = 'Kết quả tìm kiếm';
        $keyword = $this->input->post('keyword');
        $sql   = "SELECT tbl_product.id as id, code, pname, pimage1, porder, price, pactive, tbl_menu_product.name, tbl_user.user_name, tbl_product.date
                  FROM tbl_product
                  INNER JOIN tbl_menu_product
                  ON tbl_product.menu_id = tbl_menu_product.id
                  INNER JOIN tbl_user
                  ON tbl_user.user_id = tbl_product.created_by
                  WHERE pname 
                  LIKE '%".$keyword."%'
                  ORDER BY tbl_product.id ASC";
        $result = $this->product_model->queryProduct($sql);
        $data['product'] = $result;
        $data['template'] = "product/search";
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
                $data = array('pactive'=>1);
				$this->product_model->update($id, $data);
				break;
                
				case 'inactive':
                $data = array('pactive'=>0);
				$this->product_model->update($id, $data);
				break;
				}
				redirect(base_url('admin/product'), 'location');
		}
    }
    
    public function removeImage() {
        $segment4 = $this->uri->segment(4);
        $segment5 = $this->uri->segment(5);
        $segment6 = $this->uri->segment(6);
        @unlink('uploads/product/product/'.$segment6);
        @unlink('uploads/product/product/thumb_'.$segment6);
        if($segment5 == 'pimage1') {
            $dataEdit = array('pimage1' => 'no-image.png');
            $this->product_model->update($segment4, $dataEdit);
        } elseif($segment5 == 'pimage2') {
            $dataEdit = array('pimage2' => 'no-image.png');
            $this->product_model->update($segment4, $dataEdit);
        } elseif($segment5 == 'pimage3') {
            $dataEdit = array('pimage3' => 'no-image.png');
            $this->product_model->update($segment4, $dataEdit);
        } elseif($segment5 == 'pimage4') {
            $dataEdit = array('pimage4' => 'no-image.png');
            $this->product_model->update($segment4, $dataEdit);
        } else {
            $dataEdit = array('pimage5' => 'no-image.png');
            $this->product_model->update($segment4, $dataEdit);
        }
        $this->product_model->update($segment4, $dataEdit);
        redirect(base_url('admin/product/edit/'.$segment4), 'location');
    }
    
    public function import() {
        $this->load->library('csvreader');
        $data['title'] = 'Nhập File CSV Sản phẩm';

		if(isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1){
            $data['csv'] = $this->product_model->importCsv();
            $data['title'] =  'Danh sách sản phẩm giá cập nhật';
            $data['template'] = 'product/view';
            $this->load->view('layout', $data);
		} else {
            $data['template'] = 'product/import';
            $this->load->view('layout', $data);
		}
    }

    public function export() {
        $this->load->helper('download');
        $csv = $this->product_model->exportCsv();
        $name = 'product_export.csv';
        force_download($name,$csv);
    }
    
    public function check_name(){
        if($this->uri->segment(4)){
            $id = $this->uri->segment(4); 
        }else{
            $id ="";
        }
        $data = $this->product_model->check_name($this->input->post('pname'),$id);
        if($data == true){
            return true;
        }else{
            return false; 
        }
    }
}

