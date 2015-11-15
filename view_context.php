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
	
	function render_template($template_file, $vars = array())
  	{
    	if(file_exists($template_file))
    	{
      		$vars['html'] = $this;
			ob_start();
        	extract($vars);
        	include($template_file);
      		return ob_get_clean();
    	}
		else
		{
      		throw new MissingTemplateException("Template: {$template_file} could not be found!");
		}
  	}
}
?>