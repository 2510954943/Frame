<?php 
namespace libs\Facade;

use libs\Facade;

class Route extends Facade{
	public static function getFacadeClass(){
		return 'libs\Route';
	}
}