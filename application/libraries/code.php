<?php

class code{
	private $image_with    	= 120;
	private $image_height 	= 40;
	private $font         	= 'templates/font/monofont.ttf';
	private $character 	   	= 'abcdefghijklmnopqrstuvxyz';
	private $number 		= '1234567890';
	function hexrgb($hexstr)
	{
		$int = hexdec($hexstr);
		return array("red" => 0xFF & ($int >> 0x10),
		             "green" => 0xFF & ($int >> 0x8),
		             "blue" => 0xFF & $int);
	}
	function create($character_on_image)
	{
		$letter      = '0123456789abcdefghijklmnopqrstuvxyz';
		$random_dost = 10;
		$random_line = 20;
		$captcha_text_color  = '0x142864';
		$captcha_noise_color = '0x142864';
		$code = '';
		$i = 0;
		while ($i < $character_on_image)
		{
			$code  .=  substr($letter, mt_rand(0, strlen($letter) - 1), 1);
			$i++;
		}
		$_SESSION['captcha_code'] = $code;
		$font_size = $this->image_height * 0.75;
		$image = @imagecreate($this->image_with, $this->image_height);
		//Set background
		$background_color 	= imagecolorallocate($image, 255, 255, 255);
		//Array text color
		$arr_text_color   	= $this->hexrgb($captcha_text_color);
		//Text_color
		$text_color       	= imagecolorallocate($image, $arr_text_color['red'], $arr_text_color['green'], $arr_text_color['blue']);
		//Array noise_color
		$arr_noise_color  	= $this->hexrgb($captcha_noise_color);
		//Image noise_color
		$image_noise_color	= imagecolorallocate($image, $arr_noise_color['red'], $arr_noise_color['green'], $arr_noise_color['blue']);
		//Create dots randomly in background
		for ($i = 0; $i < $random_dost; $i++)
		{
			imagefilledellipse($image, mt_rand(0, $this->image_with), mt_rand(0, $this->image_height), 2, 3, $image_noise_color);
		}
		//Create line randowm in background
		for ($i = 0; $i < $random_line; $i++)
		{
			imageline($image, mt_rand(0, $this->image_with), mt_rand(0, $this->image_height), mt_rand(0, $this->image_with), mt_rand(0, $this->image_height), $image_noise_color);
		}
		//Crete textbox and add 6 letter in it
		$textbox = imagettfbbox($font_size, 0, $this->font, $code);
		$x       = ($this->image_with - $textbox[4]) / 2;
		$y       = ($this->image_height - $textbox[5]) / 2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font, $code);
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
	}
	function forward($code)
	{
		return base64_encode($code);
	}
	function reverse($code)
	{
		return base64_decode($code);
	}
	function code($length =  4, $mode = ''){
		$code      = '';
		$str	   = md5($this->character.$this->number);
		for ($i = 0; $i < $length; ++$i)
		{
			$code .= substr($str, mt_rand(0, strlen($str) - 1), 1);
		}
		return $code;
	}
}
?>