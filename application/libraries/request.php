<?php
class request
{
	/**
	 * Get All Parameter
	 * Enter description here ...
	 */
	public function getParams() 
	{
		return $_REQUEST;
	}
	
	/**
	 * Get Once Parameter
	 * Enter description here ...
	 * @param unknown_type $name
	 */
	public function getParam($name = "") 
	{
		$value = "";
		if($name) {
			$value = @$_REQUEST[$name];
		}
		return $value;
	}
	
	/**
	 * Check submit form
	 */
	public function isPost()
	{
		$flag = FALSE;
		if($_POST) {
			$flag = TRUE;
		}
		return $flag;
	}
	
}