<?php

namespace libs;

use Exception;
use JetBrains\PhpStorm\ExpectedValues;
use PDO;
/**
 * 数据库操作类（链式）
 */
class Query
{
	private static $db;
	private $table;
	private $field;
	private $where;
	private $limit;

	private function __construct()
	{
	}
	private function __clone()
	{
	}

	public static function connect($dsn, $user, $pwd)
	{
		if (empty(static::$db)) {
			static::$db = new PDO($dsn, $user, $pwd);
		}
		return new static;
	}

	public function table($tableName)
	{
		$this->table = $tableName;
		return $this;
	}
	public function field($field)
	{
		is_string($field) ?: implode(',', $field);
		$this->field($field);
		return $this;
	}
	public function where($fieldName, $value)
	{
		$this->where = ["{$fieldName}=",$value];
		return $this;
	}
	public function limit($limit)
	{
		$this->limit($limit);
		return $this;
	}

	public function select()
	{
		$sql = "SELECT * FROM {$this->table} WHERE  {$this->where[0]} ?";
		$stmt = static::$db->prepare($sql);
		$stmt->bindValue(1, $this->where[1]);
		$stmt->execute();
		// $stmt=static::$db->query($sql);
		$result = $stmt->fetchAll();
		return $result;
	}
}
