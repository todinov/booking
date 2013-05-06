<?php
session_start();

define('DEVEL', true);
define('BASEPATH', '/booking/');
define('APPPATH', 'application/');
define('SYSPATH', 'system/');
define('ERRPATH', 'errors/');

// display errors in development
if (DEVEL)
{
	error_reporting(E_ALL);
}
else
{
	error_reporting(0);
}

require APPPATH.'config/config.php';
require SYSPATH.'model.php';
require SYSPATH.'controller.php';
include SYSPATH.'helpers.php';

// get the reques string passed to index.php
$request = $_SERVER['QUERY_STRING'];

// parse the page request and other parameters
$parsed = explode('/' , $request);

// the class is the first element
$class = array_shift($parsed);

if (empty($class))
{
	$class = $default_controller;
}

//the method is the second element
if (!empty($parsed[0]))
{
	$method = array_shift($parsed);
}
else
{
	$method = 'index';
}

// modify class to fit naming convention
$class = ucfirst($class);

function __autoload($class_name) // autoload only controllers
{
	$target = APPPATH . 'controllers/'.strtolower($class_name).'.php';
	if (file_exists($target))
	{
		require $target;
	}
}

// instantiate the appropriate class and display the page
if (class_exists($class)) // calls autoload here
{
	$controller = new $class;

	if(method_exists($controller, $method))
	{
		if (!empty($parsed))
		{
			$controller->$method($parsed);
		}
		else
		{
			$controller->$method();
		}
	}
	else
	{
		show404();
	}
}
else
{
	show404();
}