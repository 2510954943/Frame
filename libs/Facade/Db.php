<?php

namespace libs\Facade;

use libs\Facade;

/**
 * 数据库委托类
 */
class Db extends Facade
{
	public static function getFacadeClass()
	{
		return 'libs\Query';
	}
}
