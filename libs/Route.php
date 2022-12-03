<?php

namespace libs;

class Route
{
	static $route;
	static $perfix;

	public function rule($url, $controller)
	{
		self::$route[self::$perfix . $url] = $controller;
	}

	public function group($perfix, $callback)
	{
		self::$perfix = $perfix;
		$callback();
		self::$perfix = '';
	}

	public function miss($controller){
		self::$route['miss']=$controller;
	}

	public function getRoute()
	{
		return self::$route;
	}
}
