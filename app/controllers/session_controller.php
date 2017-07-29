<?php

class SessionController extends Controller
{
	public function collect_post($params)
	{
    $book = trim($params["id"]);
		$user = Account::find($this->get_account_id());
		AddBookToCollection::execute($book, $user);

		#header('Location: http://reread.local/i');
	}

	public function start_reading()
	{
		$book_id = trim($_POST["book_id"]);

		$read = new Read;
		$read->book_id = $book_id;
		$read->account_id = $this->get_account_id();
		$read->started_at = date("Y-m-d H:i:s");

		$read->save();
	}

	public function login()
	{
	   $this->view("session", "login", null);
	}

	public function login_post()
	{
		$name = trim($_POST["name"]);
		$password = trim($_POST["password"]);
    $account = null;

		$result = LoginService::login($name, $password, $account);

		if (empty($account) || $result == LoginService::UNKNOWN_USERNAME)
		{
			$GLOBALS['view_context']->add_error("name", "I don't think I know you");
			$this->view("session", "login", null);
			return;
		}

    if ($result == LoginService::INVALID_PASSWORD)
		{
			$GLOBALS['view_context']->add_error("password", "I don't think you got that right");
			$this->view("session", "login", null);
			return;
		}
		$this->set_account_id($account->id);

		header('Location: http://reread.local/i');
	}

	public function index()
	{
		$reads = ReadService::GetActive();
		$books = [];
		foreach ($reads as $read)
		{
				$books[$read->book_id] = BookService::GetBook($read->book_id);
		}

		$this->view("session", "home", (object)array('reads'=>$reads, 'books'=>$books));
		return;

		header('Location: http://reread.local/i/am');
	}
}
