<?php

require 'lib/medoo.php';
require 'config/database.php';
foreach (glob("app/models/*.php") as $filename)
{
    include $filename;
}

date_default_timezone_set("UTC");

?>
