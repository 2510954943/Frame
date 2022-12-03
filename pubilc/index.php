<?php
ini_set('display_errors', true);

use libs\App;

require_once(__DIR__."/../vendor/autoload.php");

(new App())->run();



//容器测试
// $container=new Container();
// $container->bind('index',function(){
// 	return new index();
// });
// $res=$container->make('index')->index();
// var_dump($res);

