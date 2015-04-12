<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class social extends MY_Controller{
	public function __construct() {
		parent::__construct();
    }
    public function index(){
        $access_key = "15ta3thubw5jhbd0ve47";
        $secret    = "62yn9gs4spd0mw3lhak9fsmmnqgdsbbh";
        $backurl    ="http://web24h.com.vn/demo/social/misdn";
        $data = "access_key=".$access_key."&action=msisdn"."&backurl=".$backurl;
        $signature = hash_hmac("sha256", $data, $secret);
        redirect("http://api.1pay.vn/wap-charging/method?access_key=".$access_key."&action=msisdn&backurl=".$backurl."&signature=".$signature."");
        $data['title']      = "Trang mobile"; 
        $this->load->view("social/index");
    }
    public function galaxy(){
        $data['title']      = "Trang mobile"; 
        $this->load->view("social/galaxy");
    }
    public function misdn(){
        echo "<h1>Nhận dạng số điện thoại</h1>";
        echo $_GET['msisdn'];
    }
    public function error(){
        echo "<h1>Mua that bai</h1>";
        echo $_GET['msisdn'];
    }
    public function download(){
        $access_key = urlencode("15ta3thubw5jhbd0ve47");
        $action     = urlencode("charging");
        $backurl    = urlencode("http://web24h.com.vn/demo/social/misdn");
        $cid        = 68;
        $cinfo      =urlencode("Tai game pikachu");
        $errurl     = urlencode("http://web24h.com.vn/demo/social/error");
        $price      = 500;
        $transid    = urlencode($this->randomString(32));
        $secret    = "62yn9gs4spd0mw3lhak9fsmmnqgdsbbh";
        $data = "access_key=".$access_key."&action=charging"."&backurl=".$backurl."&cid=".$cid."&cinfo=".$cinfo."&errurl=".$errurl."&price=".$price."&transid=".$transid;
        $signature = hash_hmac("sha256", $data, $secret);
        redirect("http://api.1pay.vn/wap-charging/charging?access_key=".$access_key."&action=".$action."&backurl=".$backurl."&cid=".$cid."&cinfo=".$cinfo."&errurl=".$errurl."&price=".$price."&transid=".$transid."&signature=".$signature."");
   }
   public function randomString($length = 6){
        $str = "";
        $characters = array_merge(range('A','Z'),range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++){
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }
    
}

