<?php

namespace libs\Db;

use PDO;
/**
 * 数据库查询（链式）
 */
class Query extends Db
{
	private $table;
	
	private $field = '*';

	/**
	 * 查询条件值
	 * @var array
	 */
	private $whereValue = [];

	private $order;

	/**
	 * 查询条数
	 * @var string
	 */
	private $limit;

	/**
	 * 查询条件字段
	 * @var string
	 */
	protected $options;

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
	 * @return Query
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
	public function order($field,$order='asc'){
		$this->order="{$field} {$order}";
		return $this;
	}
	public function limit($limit)
	{
		$this->limit=($limit);
		return $this;
	}

	protected function getStmt()
	{
		$sql = "SELECT {$this->field} FROM {$this->table} WHERE {$this->options} ORDER BY  {$this->order} LIMIT {$this->limit} ";
		$stmt = $this->getDb()->prepare($sql);
		return $stmt;
	}

	public function select()
	{
		parent::connect();
		$stmt=$this->getStmt();
		$res = $stmt->execute($this->whereValue);
		$result = $stmt->fetchAll();
		return $result;
	}
}
