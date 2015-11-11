<?php
require 'application.php';

function parse_path() {
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
    $controller = new RereadController;
    $controller->home();
    break;
  case 'i':
    $controller = new SessionController;
    
    if (count($path_info['call_parts']) == 1)
    {
        echo("1");
        $controller->index();
    }
    else
    {
      echo("!1");
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
      }
    }
    
  
}
echo '<pre>'.print_r($path_info, true).'</pre>';

#$controller = new SessionController;

#if ($_SERVER['REQUEST_METHOD'] == "POST")
#{
#	$controller->login_post();
#}
#else
#{
#	$controller->login();	
#}



?>
