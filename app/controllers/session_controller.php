<?php
class SessionController extends Controller
{
	public function add()
	{
		$book_id = trim($_POST["book_id"]);
		
		$collection = new Collection();
		$collection->book_id = $book_id;
		$collection->account_id = $_SESSION["logged_in_user"];
		
		$collection->save();
		
		header('Location: http://reread.local/i');
	}
	
	public function login()
	{
	   $this->view("session", "login", null);
	}
	
	public function login_post()
	{
		$name = trim($_POST["name"]);
		
		$account = Account::find_by_name($name);

		if (empty($account))
		{
			$GLOBALS['view_context']->add_error("name", "I don't think I know you");
			$this->view("session", "login", null);
			return;
		}
		
		$password = trim($_POST["password"]);

		if (empty($password) || $account->password != trim($_POST["password"]))
		{
			$GLOBALS['view_context']->add_error("password", "I don't think you got that right");
			$this->view("session", "login", null);
			return;
		}
		$_SESSION["logged_in_user"] = $account->id;
		
		header('Location: http://reread.local/i');
	}
	
	public function index()
	{
		$user = Account::find($_SESSION["logged_in_user"]);
		
		if (!empty($user))
		{
			$this->view("session", "home", $user);
			return;
		}
		header('Location: http://reread.local/i/am');
	}
}