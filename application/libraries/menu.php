<?php
class menu{
	function recursiveMenu($sourceArr,$parents = 0, $url='', &$newMenu){
		if(count($sourceArr)>0){
			$newMenu .= '<ul class="topnav" >';
			foreach ($sourceArr as $key => $value){
				if($value['parent'] == $parents){
				    if($value['parent'] == 0) {
				        $newMenu .= '<li class="active"><a href="#">' . $value['name'] . '</a>';    
				    } else {
				        $newMenu .= '<li class="active"><a href="'.site_url($url.'/danh-muc-san-pham/'.$value['id'].'/'.$this->replace($value['name'])).'">' . $value['name'] . '</a>';
				    }
					
					$newParents = $value['id'];
					unset($sourceArr[$key]);
					$this->recursiveMenu($sourceArr,$newParents, $url, $newMenu);
                    $newMenu .= '</li>';
				}
			}
			$newMenu .= '</ul>';
		}
	}
    function builMenu($menu) {
	   $this->recursiveMenu($menu,0, 'thiet-bi-co-khi', $newMenu);
	   $menu = str_replace('<ul class="topnav"></ul>','',$newMenu);
       return $menu;
    }
    function builMenuElectric($menu) {
	   $this->recursiveMenu($menu,0, 'thiet-bi-dien', $newMenu);
	   $menu = str_replace('<ul class="topnav"></ul>','',$newMenu);
       return $menu;
    }
    function builMenuInformatic($menu) {
	   $this->recursiveMenu($menu,0, 'thiet-bi-van-phong', $newMenu);
	   $menu = str_replace('<ul class="topnav"></ul>','',$newMenu);
       return $menu;
    }
    function builMenuSport($menu) {
	   $this->recursiveMenu($menu,0, 'dung-cu-the-thao', $newMenu);
	   $menu = str_replace('<ul class="topnav"></ul>','',$newMenu);
       return $menu;
    }
   	function replace($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$arr_char = array(' ', ',', '.', '?', ':', ';', '~', '?', '@', '/','/(_|.|\(|\))/');
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = str_replace($arr_char, "-", $str);
		return $str;	
	}	
}