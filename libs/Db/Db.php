<?php

namespace libs\Db;

use PDO;
use libs\Config;

abstract class Db
{
	private static $db;

	private function __construct()
	{
	}
	private function __clone()
	{
	}

	protected function getDb(){
		return static::$db;
	}

	private static function getConfig($type='mysql'){
		$config = Config::config("database.{$type}");
		return $config;
	}

	public static function connect()
	{
		$config=static::getConfig();
		$dsn = "{$config['type']}:host={$config['host']};dbname={$config['dbname']}";
		$user = $config['username'];
		$pwd = $config['pwd'];
		if (empty(static::$db)) {
			static::$db = new PDO($dsn, $user, $pwd);
		}
		return new static;
	}

	protected abstract function getStmt();
}
