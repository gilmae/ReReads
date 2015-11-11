<?php
class RereadController extends Controller
{
	public function home()
	{
		echo $_SESSION["logged_in_user"];
	}
}
?>