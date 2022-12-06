<?php

namespace libs;

class Config
{
	/**
	 * 读取配置
	 * @return array
	 */
	public static function loadConfig()
	{
		$configFiles=glob(dirname(__DIR__).'\config\*.php');
		$config=[];
		foreach($configFiles as $file){
			$baseName=basename($file,'.php');
			$config[$baseName]=require_once($file);
		}
		return $config;
	}

	/**
	 * 获取配置参数
	 * @param string $key
	 * @return array|string
	 */
	public static function config($key=''){
		$keyArr=explode('.',$key);
		global $_CONFIG;
		$config=$_CONFIG;
		foreach($keyArr as $v){
			$config=$config[$v]??'';
		}
		return $config;
	}
}
