<?php
  class LoginService
  {
    const UNKNOWN_USERNAME = 1;
    const INVALID_PASSWORD = 2;

    function Login($username, $password, &$account)
    {
      $account = Account::find_by_name($username);

      if (empty($account))
      {
        return UNKNOWN_USERNAME;
      }

      if (empty($password) || $account->password != trim($_POST["password"]))
	    {
	       return INVALID_PASSWORD;
		  }

      return 0;
   }
 }
?>
