<?php

require 'vendor/autoload.php';

foreach (glob("config/*.php") as $filename)
{
    include $filename;
}

#require 'lib/medoo.php';

require 'view_context.php';
foreach (glob("app/models/*.php") as $filename)
{
    include $filename;
}

foreach (glob("db/*.php") as $filename)
{
    include $filename;
}

foreach (glob("app/controllers/*.php") as $filename)
{
    include $filename;
}

foreach (glob("app/services/*.php") as $filename)
{
    include $filename;
}

date_default_timezone_set("UTC");
if (php_sapi_name() != "cli")
{
  session_start();
}

	// TODO Find a place for this, some sort of View renderer

     $GLOBALS['view_context'] = new ViewContext;
?>
