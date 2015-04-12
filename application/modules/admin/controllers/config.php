<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class config extends CI_Controller {
	public function __construct() {
		parent::__construct();
        session_start();   
	    if(!isset($_SESSION['admin']) || !isset($_SESSION['level']) || $_SESSION['level'] < 2){
     	      redirect(base_url().'admin/login');
      	 }
    }
    public function index() {
        //Check permisson
		if(!$this->check->is_allowed($_SESSION['permission'], 'config_view')) {
			show_error('Bạn không có quyền truy cập vào trang này. Liên hệ với Ban Quản Trị');
			die();
		}
		//End Check permission
   	    if (file_exists('application/config/application.php')) {
			$data['existFile'] = true;
			//Edit file
			if (@is_writable('application/config/application.php')) {
				$data['isWrite'] = true;
				$data['successEdit'] = false;
				if ($this->session->flashdata('sessionSuccessEdit'))
				{
					$data['successEdit'] = true;
				}
				if (isset($_POST['isSubmit']) && $_POST['isSubmit'] == 1)
				{
					//Load helper file
					$this->load->helper('file');
					
					$config  = "<?php"."\n";
					$config .= "if ( ! defined('BASEPATH')) exit('No direct script access allowed');"."\n";
					$config .= "//System Information"."\n";
                    $config .= "$"."config['config_background'] 	= '".$this->input->post('bgnew')."';"."\n";
                    $config .= "$"."config['config_favicon'] 		= '".$this->input->post('favicon')."';"."\n";
                    $config .= "$"."config['config_logo'] 			= '".$this->input->post('logo_website')."';"."\n";
                    $config .= "$"."config['config_banner'] 		= '".$this->input->post('banner')."';"."\n";
                    $config .= "$"."config['config_banner1'] 		= '".$this->input->post('banner1')."';"."\n";
                    $config .= "$"."config['config_banner2'] 		= '".$this->input->post('banner2')."';"."\n";
                    $config .= "$"."config['config_banner3'] 		= '".$this->input->post('banner3')."';"."\n";
                    $config .= "$"."config['config_banner4'] 		= '".$this->input->post('banner4')."';"."\n";
                    $config .= "$"."config['config_contact'] 		= '".$this->input->post('contact')."';"."\n";
                    $config .= "$"."config['config_footer'] 		= '".$this->input->post('footer')."';"."\n";
                    $config .= "$"."config['config_notice'] 		= '".$this->input->post('notice')."';"."\n";
					$config .= "$"."config['config_website_name'] 	= '".$this->input->post('website_name')."';"."\n";
                    $config .= "$"."config['config_website_subject']= '".$this->input->post('website_subject')."';"."\n";
                    $config .= "$"."config['config_desciption'] 	= '".$this->input->post('desciption')."';"."\n";
                    $config .= "$"."config['config_keywords'] 		= '".$this->input->post('keywords')."';"."\n";
                    $config .= "$"."config['title_page'] 			= '".$this->input->post('title_page')."';"."\n";
                    $config .= "$"."config['meta_desc'] 			= '".$this->input->post('meta_desc')."';"."\n";
                    $config .= "$"."config['meta_keyword'] 			= '".$this->input->post('meta_keyword')."';"."\n";
                    $config .= "$"."config['config_address'] 		= '".$this->input->post('address')."';"."\n";
                    $config .= "$"."config['config_website'] 		= '".$this->input->post('website')."';"."\n";
                    $config .= "$"."config['config_province'] 		= '".$this->input->post('province')."';"."\n";
                    $config .= "$"."config['config_district'] 		= '".$this->input->post('district')."';"."\n";
                    $config .= "$"."config['config_email'] 			= '".$this->input->post('email')."';"."\n";
                    $config .= "$"."config['config_skype'] 			= '".$this->input->post('skype')."';"."\n";
                    $config .= "$"."config['config_yahoo'] 			= '".$this->input->post('yahoo')."';"."\n";
                    $config .= "$"."config['config_facebook'] 		= '".$this->input->post('facebook')."';"."\n";
                    $config .= "$"."config['config_phone'] 			= '".$this->input->post('phone')."';"."\n";
                    $config .= "$"."config['config_mobile'] 		= '".$this->input->post('mobile')."';"."\n";
                    $config .= "$"."config['config_fax'] 			= '".$this->input->post('fax')."';"."\n";
					$config .= "//Config System"."\n";
					if ($this->input->post('maintain') == 1)
					{
						$config_maintain = 1;
					}
					else 
					{
						$config_maintain = 0;
					}
					$config .= "$"."config['config_maintain'] = '".$config_maintain."';"."\n";
					
					if (write_file('application/config/application.php', $config)) {
						$this->session->set_flashdata('sessionSuccessEdit', 1);
					}
					redirect(site_url('admin/config/index'), 'location');
				  }
			}
			else  {
				$data['isWrite'] = false;
				$data['successEdit'] = false;
			}
				
				//Load data from file
                $data['config_background'] 	    = $this->config->item('config_background');
			    $data['config_favicon'] 	    = $this->config->item('config_favicon');
                $data['config_logo'] 	        = $this->config->item('config_logo');
   				$data['config_banner'] 	        = $this->config->item('config_banner');
                $data['config_banner1'] 	    = $this->config->item('config_banner1');
                $data['config_banner2'] 	    = $this->config->item('config_banner2');
                $data['config_banner3'] 	    = $this->config->item('config_banner3');
                $data['config_banner4'] 	    = $this->config->item('config_banner4');                         				
				$data['config_contact'] 	    = $this->config->item('config_contact');
                $data['config_footer']          = $this->config->item('config_footer');
                $data['config_notice']          = $this->config->item('config_notice');
				$data['config_website_name'] 	= $this->config->item('config_website_name');
                $data['config_website_subject'] = $this->config->item('config_website_subject');
				$data['config_desciption'] 	    = $this->config->item('config_desciption');
				$data['config_keywords']        = $this->config->item('config_keywords');
				$data['title_page']        		= $this->config->item('title_page');
				$data['meta_desc']        		= $this->config->item('meta_desc');
				$data['meta_keyword']        	= $this->config->item('meta_keyword');
                $data['config_address' ]        = $this->config->item('config_address');
                $data['config_province']        = $this->config->item('config_province');
                $data['config_website']         = $this->config->item('config_website');
                $data['config_district']        = $this->config->item('config_district');
                $data['config_email']           = $this->config->item('config_email');
                $data['config_skype']           = $this->config->item('config_skype');
                $data['config_yahoo']           = $this->config->item('config_yahoo');
                $data['config_facebook']        = $this->config->item('config_facebook');
                $data['config_phone']           = $this->config->item('config_phone');
                $data['config_mobile']          = $this->config->item('config_mobile');
                $data['config_fax']             = $this->config->item('config_fax');
				$data['config_maintain']		= $this->config->item('config_maintain');
		}
		else {
			$data['existFile'] = false;
		}	
		
		//Load data
		$data['title'] = "Cấu hình toàn bộ trang";
		$data['template'] = "config/default";
		$this->load->view("layout",$data);
    }
}

