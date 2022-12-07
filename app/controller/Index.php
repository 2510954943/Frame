<?php

namespace app\controller;

use libs\Facade\Db;
use libs\Query;

class index
{
	
	public function index()
	{
		echo 'hello word';
	}

	public function dbTest(){
		$res=Query::connect()->table('tp_admin')->where('id','>',1)->order('id')->limit(3)->select();
		var_dump($res);
	}
}
