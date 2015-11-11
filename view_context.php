<?php
class ViewContext
{
	private $errors = array();
	
	function add_error($prop, $error)
	{
		$this->errors[$prop] = $error;
	}
	
	function error_for($prop)
	{
		if (array_key_exists($prop, $this->errors))
		{
			return $this->errors[$prop];
		}
		return "";
	}
}
?>