<?php
use libs\Facade\Route;

// Route::rule('get','index/get');
Route::rule('/','index/index');
Route::miss('index/miss');


Route::group('index',function(){
	Route::rule('/get','index/get');
	Route::rule('/post','index/post');
}); 