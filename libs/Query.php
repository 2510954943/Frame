<?php

namespace libs;

use PDO;
use PDOException;

/**
 * 数据库操作类（链式）
 */
class Query
{
	private static $db;
	private $table;
	private $field = '*';
	private $whereValue = [];
	private $limit;
	protected $options;

	private function __construct()
	{
	}
	private function __clone()
	{
	}

	public static function connect()
	{
		$config = Config::config('database.Mysql');
		$dsn = "{$config['type']}:host={$config['host']};dbname={$config['dbname']}";
		$user = $config['username'];
		$pwd = $config['pwd'];
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

	/**
	 * @param string $fieldName		查询字段
	 * @param string $op			查询表达式
	 * @param string $value			查询条件
	 * @return void
	 */
	public function where($fieldName, $op = '=', $value)
	{
		if (!empty($this->options)) {
			$this->options .= ' AND ';
		}
		$this->options .= "{$fieldName} {$op} ? ";
		$this->whereValue[] = $value;
		return $this;
	}
	public function limit($limit)
	{
		$this->limit($limit);
		return $this;
	}

	protected function getStmt()
	{
		$sql = "SELECT {$this->field} FROM {$this->table} WHERE {$this->options}";
		$stmt = static::$db->prepare($sql);
		return $stmt;
	}

	public function select()
	{
		$stmt=$this->getStmt();
		$res = $stmt->execute($this->whereValue);

		$result = $stmt->fetchAll();
		return $result;
	}
}
