<?php
/*

/i						User's detail's'
/i/am					Login
/i/am_this				Login POST back

/my/books				User's book's
/my/copy_of/{{book}}	User's copy of a book, including Reads
/my/read_of/{{book}}	User's current reading session with a book

/ 						general landing page
*/

require "vendor/altorouter/altorouter/AltoRouter.php";
class Router
{
  private $router;

  function __construct()
  {
    $this->router = new AltoRouter();

    $this->router->map('GET', '/', array('c'=>'Session', 'a'=>'index'), 'root');
    $this->router->map('GET', '/i', array('c'=>'Session', 'a'=>'index'), 'user_home');
    $this->router->map('GET', '/i/am', array('c'=>'Session', 'a'=>'login'), 'login');
    $this->router->map('POST', '/i/am', array('c'=>'Session', 'a'=>'login_post'), 'login_post');

    $this->router->map('GET', '/i/collect/[a:id]', array('c'=>'Session', 'a'=>'collect_post'), 'user_collect_book');

    $this->router->map('GET', '/i/start_reading/[i:id]', array('c'=>'Session', 'a'=>'start_reading'), 'user_starts_reading');

    $this->router->map('GET', '/book/search', array('c'=>'Book', 'a'=>'search'), 'search_for_book');
    $this->router->map('GET', '/book/googlesearch', array('c'=>'Book', 'a'=>'search_google'), 'googlesearch_for_book');

    $this->router->map('GET', '/book/new', array('c'=>'Book', 'a'=>'add'), 'enter_a_new_book');
    $this->router->map('POST', '/book/new', array('c'=>'Book', 'a'=>'add_post'), 'save_a_new_book');
    $this->router->map('GET', '/[a:username]', array('c'=>'User', 'a'=>'index'), 'other_user_home');
  }

  function route()
  {
    $match = $this->router->match();

    $controller_name = $match['target']['c']."Controller";

    $controller = new $controller_name;

    $controller->$match['target']['a']($match['params']);
  }
}

 ?>
