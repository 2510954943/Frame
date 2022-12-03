<?php

namespace libs;

use Closure;
use libs\Db as LibsDb;

class Container
{
	public $instances = []; //实例容器

	/**
	 * 绑定类实例到容器中
	 * @param string $className
	 * @param Closure $process
	 * @return void
	 */
	public function bind(string $className, $process): void
	{
		if (!isset($this->instances[$className])) {
			$this->instances[$className] = $process;
		}
	}

	/**
	 * @param [type] $className
	 * @param array $params
	 * @return obj
	 */
	public function make($className, $params = [])
	{
		return call_user_func_array($this->instances[$className], $params);
	}
}
