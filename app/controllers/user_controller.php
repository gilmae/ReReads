<?php
class UserController extends Controller
{
	public function index($params)
	{
    $user = Account::find_by_name($params['username']);

    if (!empty($user))
		{
			$owned_books = Book::find_by_owner($user->id);
			$this->view("session", "home", (object)array('user'=>$user, 'owned_books'=>$owned_books));
			return;
		}
	}
}
?>
