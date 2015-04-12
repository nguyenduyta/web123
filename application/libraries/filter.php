<?php if(!defined('BASEPATH'))exit('No direct script access allowed');
/*
* Class Filter.
*	function injection, injection_html. Filter data input
*	function html . Filter htmlspecialcharacter
*/
class filter 
{
	function injection($str)
	{
		$str = str_replace("~", "&tilde;", $str);
		$str = str_replace("`", "&lsquo;", $str);
		$str = str_replace("#", "&curren;", $str);
		$str = str_replace("%", "&permil;", $str);
		$str = str_replace("'", "&rsquo;", $str);
		$str = str_replace("\"", "&quot;", $str);
		$str = str_replace("\\", "&frasl;", $str);
		$str = str_replace("--", "&ndash;&ndash;", $str);
		$str = str_replace("ar(", "ar&Ccedil;", $str);
		$str = str_replace("Ar(", "Ar&Ccedil;", $str);
		$str = str_replace("aR(", "aR&Ccedil;", $str);
		$str = str_replace("AR(", "AR&Ccedil;", $str);
		return $str;
	}
	function html($str)
	{
		return htmlspecialchars($str);
	}
	function injection_html($str)
	{
		return $this->injection($this->html($str));
	}
	function clear($str)
	{
		$str = str_replace("~", "", $str);
		$str = str_replace("`", "", $str);
		$str = str_replace("#", "", $str);
		$str = str_replace("%", "", $str);
		$str = str_replace("&", "", $str);
		$str = str_replace("'", "", $str);
		$str = str_replace("\"", "", $str);
		$str = str_replace("\\", "", $str);
		$str = str_replace("/", "", $str);
		$str = str_replace("<", "", $str);
		$str = str_replace(">", "", $str);
		return $str;
	}
}
?>