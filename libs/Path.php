<?php

namespace libs;

use Exception;
use libs\Facade\Route;

class path
{

	/**
	 * 访问控制器方法分发
	 * @return array
	 */
	public function init()
	{
		global $_CONFIG;
		if ($_CONFIG['app']['with_route']) {
			return self::goRoute();
		} else {
			return self::goUrl();
		}
	}

	/**
	 * 使用路由
	 * @return array
	 */
	public static function goRoute()
	{
		$routeFiles = glob(dirname(__DIR__) . '/route/*.php');
		foreach ($routeFiles as $route) {
			require_once($route);
		}
		$routes = Route::getRoute();
		$pathInfo = self::getPathInfo();
		if (!empty($routes)) {
			//匹配路由
			foreach ($routes as $k => $v) {
				if ($pathInfo == $k) {
					$routeAddress = $v;
					// var_dump($routeAddress);exit;
					$routeAddress = explode('/', $routeAddress);
					$controllerName = "app\\controller\\" . ucfirst($routeAddress[0]);
					return ['controllerName' => $controllerName, 'method' => $routeAddress[1]];
				}
			}
			if (isset($routes['miss'])) {
				$routeAddress = explode('/', $routes['miss']);
				$controllerName = "app\\controller\\" . ucfirst($routeAddress[0]);
				return ['controllerName' => $controllerName, 'method' => $routeAddress[1]];
			} else {
				return 'cuowu';
			}
		} else {
			throw new Exception('Route未注册');
		}
	}

	/**
	 * 默认不使用路由
	 * @return array
	 */
	public static function goUrl()
	{
		$pathInfo = self::getPathInfo() != '/' ? self::getPathInfo() : 'Index/index';

		$pathInfo = explode('/', $pathInfo);
		$controller = "app\\controller\\" . ucfirst($pathInfo[0]);
		$method = $pathInfo[1];
		return ['controllerName' => $controller, 'method' => $method];
	}

	/**
	 * 处理url
	 * @return str
	 */
	protected static function getPathInfo()
	{
		$path = $_SERVER['REQUEST_URI'] == '/' ? '/' : substr($_SERVER['REQUEST_URI'], 1);  //去除开头的斜杠
		return $path;
	}
}
