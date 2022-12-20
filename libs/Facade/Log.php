<?php
namespace libs\Facade;

use libs\Facade;

class Log extends Facade{
	public static function getFacadeClass(){
		return 'libs\Log';
	}
}