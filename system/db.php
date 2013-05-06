<?php

// singleton db class using pdo
class Database {
	private static $instance;
	private $PDOInstance;

	private function __construct()
	{
		try
		{
			$this->PDOInstance = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
			$this->PDOInstance->setAttribute(PDO::ATTR_ERRMODE, PDO_ERRMODE);
		}
		catch(PDOException $e)
		{
			throw $e;
		}
	}

	public static function getInstance()
	{
		if (!self::$instance) // create an instance, if there isn't one
		{
			try
			{
				self::$instance = new self();
			}
			catch(PDOException $e)
			{
				die($e->getMessage());
			}
		}
		return self::$instance->getPDOInstance();
	}

	public function getPDOInstance() 
	{
		return $this->PDOInstance;
	}
}