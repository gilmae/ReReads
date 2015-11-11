<?php
class Controller
{
	protected $errors = []; 

    public function add_error($prop, $error)
	{
		$errors[$prop] = $error;
	}
	
	public function error_for($prop)
	{
		return $errors[$prop];
	}
  
	public function view($controller, $view, $model)
	{
		//include("app/views/".$controller."/".$view.".php");
		$view = $this->render_template("app/views/".$controller."/".$view.".php", array('html'=>$GLOBALS['view_context'], 'model'=>$model, 'errors'=>$this->errors));
		echo($view);
	}
	
	function render_template($template_file, $vars = array())
  {
    if(file_exists($template_file))
    {
      ob_start();
        extract($vars);
        include($template_file);
      return ob_get_clean();
    }else
      throw new MissingTemplateException("Template: {$template_file} could not be found!");
  }
	

}
?>