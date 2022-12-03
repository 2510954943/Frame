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
}
