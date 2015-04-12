<?php

	function createMenu($name,$value = null, $options ){
		$xhtml = '<ul name="' . $name . '" id="' . $name . '" >';
      		foreach ($options as $key=> $info){
			if($info['level'] == 1){
				$xhtml .= '<option value="' . $info['id'] . '">+ ' . $info['name'] . '</option>';
			}else{
				$string = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				$newString = '';
				for($i=1;$i<$info['level']; $i++){
					$newString .= $string;
				}
				$info['name'] = $newString . '-' . $info['name'];
				$xhtml .= '<option value="' . $info['id'] . '" >' . $info['name'] . '</option>';
			}
		   }
		$xhtml .= '</ul>';
		return $xhtml;
	}

	function getNumber($n,$select="") {	
		for($i = 0; $i <= $n; $i++) {
			echo $html = "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
		}
	}

	function getYear($start,$end){
		for($start; $start <= $end; $start++) {
			echo $html = "<option value='".str_pad($start, 4, '0', STR_PAD_LEFT)."'>".str_pad($start, 2, '0', STR_PAD_LEFT)."</option>";
		}	
	}

	function debug($data = array()) {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}