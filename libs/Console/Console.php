<?php

namespace libs\console;

use libs\Config;

/**
 * 控制台执行类
 */
class console
{
	public function run()
	{
		self::loadConfig();
		self::runConsole();
	}

	/**
	 * 读取所有配置项
	 * @return void
	 */
	protected static function loadConfig()
	{
		global $_CONFIG;
		$_CONFIG = Config::loadConfig();
	}

	protected static function runConsole(){
		global $_CONFIG;
		$console=$_CONFIG['console'];
		$args=$GLOBALS['argv'];   //获取控制台的参数
		array_shift($args);
		if(isset($console[$args[0]])){
			$class=new $console[$args[0]];
			$class->handle();
		}
		else{
			exit('没有该指令');
		}
	}
}
