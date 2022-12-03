<?php

namespace libs;

use libs\Config;
use libs\path;

class App
{
	public function run()
	{
		
		self::loadConfig();
		self::runAction();
	}

	/**
	 * 读取所有配置项
	 * @return void
	 */
	protected static function loadConfig(){
		global $_CONFIG;
		$_CONFIG= Config::loadConfig();
	}

	/**
	 * 加载控制器及方法
	 * @return void
	 */
	protected static function runAction()
	{
		$path = path::Init();
		// var_dump($path);exit;
		$controllerName = $path['controllerName'];
		if (class_exists($controllerName)) {
			$controller = new $controllerName();
			$method = $path['method'];
			if (method_exists($controller, $method)) {
				return $controller->$method();
			} else {
				throw new \Exception("控制器.$controllerName.的方法.$method.不存在");
			}
		}
		else{
			throw new \Exception("控制器.$controllerName.不存在");
		}
	}

}
