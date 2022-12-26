<?php

namespace libs;

/**
 * 路由处理类
 */
class Route
{
	static $route;
	static $perfix;

	/**
	 * 添加路由规则
	 * @param string $url   		匹配路由
	 * @param string $controller	目标控制器
	 * @return void
	 */
	public function rule($url, $controller)
	{
		self::$route[self::$perfix . $url] = $controller;
	}

	/**
	 * 分组路由
	 * @param string $perfix		分组前缀
	 * @param Closure $callback
	 * @return void
	 */
	public function group($perfix, $callback)
	{
		self::$perfix = $perfix;
		$callback();
		self::$perfix = ''; //释放分组变量，防多个分组复用
	}

	/**
	 * miss路由，当路由全部匹配不上时使用
	 * @param string $controller
	 * @return void
	 */
	public function miss($controller){
		self::$route['miss']=$controller;
	}
	
	public function getRoute()
	{
		return self::$route;
	}
}
