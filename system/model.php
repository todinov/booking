<?php

require SYSPATH.'db.php';

class Model {
	protected $db;
	public function __construct()
	{
		$this->db = Database::getInstance();
	}
}