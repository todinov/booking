<?php

class Controller {
	protected $vars;

	function __construct()
	{
		$this->vars = array();
	}

	public function assign($name, $value) {
		$this->vars[$name] = is_object($value) ? $value->fetch() : $value;
	}

	// include a view
	public function view($view)
	{
		if (is_array($this->vars)) 
		{
			extract($this->vars); // pass variables to the view
		}
		$target = APPPATH.'views/'.$view.'.php';
		if (file_exists($target))
		{
			include $target;
		}
	}

	// include a model
	public function model($model)
	{
		$target = APPPATH.'models/'.strtolower($model).'.php';
		if (file_exists($target))
		{
			include $target;
			return new $model();
		}
		else
		{
			return false;
		}
	}
}