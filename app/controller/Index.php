<?php

namespace app\controller;

use libs\Facade\Db;

class index
{
	
	public function index()
	{
		echo 'hello word';
	}
	public function get(){
		// $res = Db::table('tp_auth_rule')->where('id', 1)->select();
		// var_dump($res);
		echo 'get';
	}
	public function post(){
		echo 'post';
	}
	public function miss(){
		echo '这里是miss';
	}
}
