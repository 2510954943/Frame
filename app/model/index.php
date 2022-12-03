<?php

namespace app\model;

ini_set('display_errors', true);
require_once(__DIR__ . "/../../vendor/autoload.php");

use libs\Query;

class index extends Query
{
	protected $type = 'mysql';
	protected $host = 'localhost';
	protected $database = 'tp6';
	protected $username = 'root';
	protected $pwd = 'root';
	protected $port = '3306';
	public function __construct()
	{
		$dsn = "$this->type:host=$this->host;dbname=$this->dbname";
		$q = static::connect($dsn, $this->username, $this->pwd);
	}
}
new index;