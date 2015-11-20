<?php
/*function parse_path() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    if (count($request_path) > 1)
    {
      $path['query_utf8'] = urldecode($request_path[1]);
      $path['query'] = utf8_decode(urldecode($request_path[1]));
    
      $vars = explode('&', $path['query']);
      foreach ($vars as $var) {
        $t = explode('=', $var);
        $path['query_vars'][$t[0]] = $t[1];
      }
    }
    else
    {
      $path['query_utf8'] = '';
      $path['query'] = '';
      $path['query_vars'] = array();
    }
  }
return $path;
}

$path_info = parse_path();

switch($path_info['call_parts'][0])
{
  case "":
    $controller = "Reread";
    $controller->home();
    break;
  case 'i':
    $controller = "Session";
    
    if (count($path_info['call_parts']) == 1)
    {
        $controller->index();
    }
    else
    {
      switch ($path_info['call_parts'][1])
      {
        case 'am':
          if ($_SERVER['REQUEST_METHOD'] == "POST")
          {
            $controller->login_post();
          }
          else
          {
            $controller->login();
          }
          break;
        case 'add':
          $controller->add();
          break;
        case 'start_reading':
          $controller->start_reading();
          break;
      }
    }
}
*/

require "vendor/altorouter/altorouter/AltoRouter.php";
class Router
{
  private $router;
  
  function Router()
  { 
    $this->router = new AltoRouter();
  
    $this->router->map('GET', '/i', array('c'=>'Session', 'a'=>'index'), 'user_home');
    $this->router->map('GET', '/i/am', array('c'=>'Session', 'a'=>'login'), 'login');
    $this->router->map('POST', '/i/am', array('c'=>'Session', 'a'=>'login_post'), 'login_post');
    $this->router->map('GET', '/i/add/[i:id]', array('c'=>'Session', 'a'=>'add'), 'user_add_book');
    $this->router->map('GET', '/i/start_reading/[i:id]', array('c'=>'Session', 'a'=>'start_reading'), 'user_starts_reading');
  }
  
  function route()
  {
    $match = $this->router->match();

    $controller_name = $match['target']['c']."Controller";

    $controller = new $controller_name;

    $controller->$match['target']['a']();
  }
}
?>
