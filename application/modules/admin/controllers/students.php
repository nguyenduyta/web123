<?php 
/**
*  Class Course
*  Author: HTKHOI
*  Date: 17/03/2014
*/
class students extends Admin_Controller
{

    /**
     * List Course
     * @not params
     */
    public function index()
    {
    	$data 	= array();
        //Get Params
        $data['title'] 		= "Danh sách sinh viên";
        $data['template']	= "exam/list";
    	$this->load->view("layout",$data);
    }
}