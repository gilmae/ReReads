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
		$ctx = $GLOBALS['view_context'];
		$view = $ctx->render_template("app/views/".$controller."/".$view.".php", array('html'=>$ctx, 'model'=>$model, 'errors'=>$this->errors));
		echo($view);
	}

	protected function set_account_id($id)
	{
		$_SESSION["logged_in_user"] = $id;
	}

	protected function get_account_id()
	{
	   return	$_SESSION["logged_in_user"];
	}


}
?>
