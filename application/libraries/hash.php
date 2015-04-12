<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
/**
 * Class hash tao chuoi ki tu bao ve
 * Function key tao key cho chuoi hash
 */
class hash 
{
	function key($length = 1)
	{
		$character    = 'abcdefghijklmnopqrstuvxyz';
		$number       = '0123456789';
		$special_char = '_-.';
		$string		  = $character.strtoupper($character).$number.$special_char;
		$key   		  = '';
		for ($i = 0; $i < $length ; $i++)
		{
			$key = $key.substr($string, rand(0, strlen($string)), 1);
		}
		return $key;
	}
	function create($data, $key = NULL)
	{
		$data        =   md5($data);
		$character   =   'abcdefghijklmnopqrstuvzyz-_.';
		$number      =   '1234567890';
		$string      = 	 $character.$number;
		$data        =   md5($data.$string.$key);
		return $data;
	}
}
?>