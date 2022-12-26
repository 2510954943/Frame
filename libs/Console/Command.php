<?php

namespace libs\console;

/**
 * 命令行基类
 */
abstract class Command
{
	/**
	 * 命令行接收的参数
	 */
	protected $args;

	abstract function handle();

	public function __construct()
	{
		$args = $GLOBALS['argv'];
		array_shift($args);
		array_shift($args);
		$this->args=$args;
	}
}
