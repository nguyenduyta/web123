<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');
/**
 *Class Check:
 *  function is_allowed($permission = 'none', $action = ''): Kiem tra quyen truy cap
 *  function is_more($first, $second): Neu so $first > $second thi tra ve true. Nguoc lai tra ve false
 *  function is_same($firstStr, $secondStr): Neu $firstStr va $secondStr la giong nhau thi tra ve true. Nguoc lai tra ve false
 *  function is_phone($phone): Neu dung la so dien thoai theo qui dinh thi tra ve true, nguoc lai tra ve false
 *  function is_id($id): Kiem tra xem $id co phai la ID
**/
class check {
	
	function is_allowed($permission = 'none', $action = '') {
		if($permission && trim($permission) != '' && strtolower($permission) == 'all') {
			return true;
		}
		elseif($permission && trim($permission) != '' && strtolower($permission) != 'none' && $action && trim($action) != '' && stristr($permission, $action)) {
			return true;
		}
		return false;
	}

	function is_more($first, $second, $equal = true) {
		if($equal == true) {
            if((float)$first >= (float)$second) {
				return true;
			}
		}
		else {
            if((float)$first > (float)$second) {
				return true;
			}
		}
		return false;
	}
	
	function is_same($firstStr, $secondStr) {
		if((string)$firstStr === (string)$secondStr) {
			return true;
		}
		return false;
	}
	
	function is_phone($phone) {
		if(preg_match('/[^0-9().]/i', $phone)) {
			return false;
		}
		return true;
	}
	
	function is_id($id) {
        if(preg_match('/[^0-9]/i', $id) || (int)$id <= 0) {
			return false;
		}
		return true;
	}
}