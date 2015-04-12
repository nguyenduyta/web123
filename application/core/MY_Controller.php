<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
    
    public function __construct()
    {
        session_start();
        parent::__construct();
        //Load model
        $this->load->model("cate_news_mode");
        $this->load->model("khoahoc_model");
        $this->load->model("course_model");
        $this->load->model("toppic_model");
        $this->load->model("project_model");
        $this->load->model("comment_model");
        $this->load->model("video_model");
        $this->load->model("tuts_model");
    }

    /**
     * get Cource
     */
    protected function getCource()
    {
        $course = $this->course_model->getAll();
        if($course != null ) {
            foreach ($course as $key => $value) {
                //Image
                if($value['course_image'] != null ) {
                    $course[$key]['course_image'] = $value['course_image'];
                } else {
                    $course[$key]['course_image'] = "/uploads/suntech/default_image.png";
                }
                //Link detail   
                $course[$key]['detail'] = site_url(strtolower($value['course_url']."-".$value['course_id']));
                //Link tuts
                if($value['tuts'] != null) {
                    $stt = 0;
                    foreach ($course[$key]['tuts'] as $keyTuts => $valueTuts) {
                        if($valueTuts['url'] == null) {
                            $course[$key]['tuts'][$keyTuts]['url'] = site_url(strtolower("hoc-php"."/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                        } else {
                            $course[$key]['tuts'][$keyTuts]['url'] = site_url(strtolower($valueTuts['url']."/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                        }
                        //style border-bottom
                        $stt++;
                        if($stt == 5 ){
                            $course[$key]['tuts'][$keyTuts]['style']  = "style='border-bottom:none;'";       
                            $stt = 1;
                        }
                    }
                }
            }
        }
        return $course;
    }

    /**
     * get Toppic
     */
    protected function getTopic()
    {
    	$toppic = $this->toppic_model->getAlltoppic();
        if($toppic != null ) {
            foreach ($toppic as $key => $value) {
                $toppic[$key]['url'] = site_url(strtolower("chuyen-de/".$value['url']."-".$value['id']));
            }
        }
        return $toppic;
    }
    /**
     * get tuts topic
     * Danh sách bài viết menu chuyên đề
     */
    protected function getTutTopic()
    {
    	//$Tuts Toppic
        $tutsToppic = $this->tuts_model->tutToppicTop();
        if($tutsToppic != null ) {
            foreach ($tutsToppic as $keyTuts => $valueTuts) {
                if($valueTuts['url'] != null ) {
                    $tutsToppic[$keyTuts]['detail'] = site_url(strtolower($valueTuts['url']."/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                } else {
                    $tutsToppic[$keyTuts]['detail'] = site_url(strtolower("hoc-php/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                }
            }
        }
        return $tutsToppic;
    }
    /**
     * get Tuts course
     * Bài viết ở menu khóa học
     */
    protected function getTutCourse()
    {
    	//Tuts Course
        $tutsCourse = $this->tuts_model->tutCourseTop();
        if($tutsCourse != null ) {
                foreach ($tutsCourse as $keyTuts => $valueTuts) {
                    $tutsCourse[$keyTuts]['url'] = site_url(strtolower($valueTuts['course_url']."/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                }
        }
        return $tutsCourse;
    }

    /**
     * get project
     * List project
     */
    protected function getProject()
    {
        $project = $this->project_model->listProject();
        if($project != null ) {
            foreach ($project as $key => $valueProject) {
                $project[$key]['detail'] = site_url(strtolower("project-php/".$valueProject['project_url']."-".$valueProject['project_id']));
            }
        }
        return $project;
    }

    /**
     * get tuts news
     */
    protected function getTutNew()
    {
    	//Tuts new.
        $tutsNews = $this->tuts_model->tutsNews();
        if($tutsNews != null ) :
            foreach ($tutsNews as $key => $valueTuts) {
                if($valueTuts['url'] != null ) {
                    $tutsNews[$key]["news_detail"] = site_url(strtolower($valueTuts['url']."/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                } else {    
                    $tutsNews[$key]["news_detail"] = site_url(strtolower("hoc-php/".$valueTuts['news_url']."-".$valueTuts['news_id']));
                }
            }
        endif;
        return $tutsNews;
    }

    /**
     * get new video
     * Hien thi 10 video moi nhat
     */
    protected function getNewVideo()
    {
        $videoNews = $this->video_model->videoNews();
        if($videoNews != null ) {
            foreach ($videoNews as $key => $valueVideo) {
                $videoNews[$key]['detail'] = site_url("video-hoc-php/".$valueVideo['video_url']."-".$valueVideo['video_id']);
            }
        }
        return $videoNews;
    }

    /**
     * Show bài viết ở phần Góc chia sẻ
     * not @param
     */
    protected function getNewShare()
    {
        $newShares = $this->tuts_model->newShare();
        if($newShares != null ) {
            foreach ($newShares as $key => $value) {
                $newShares[$key]['detail'] = site_url("hoc-php/".$value['news_url']."-".$value['news_id']);
            }
        }
        return $newShares;
    }
}
