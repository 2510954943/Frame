<?php
namespace libs;

use libs\Config;

class Log{
	public function openLog(){
		$month=date('Ym');
		$dir=dirname(dirname(__FILE__)).'\runtime\\'.$month;
		$file=$dir.'\\'.date('d').'.txt';
		if(file_exists($dir)){
			return fopen($file,'a');
		}
		else{
			mkdir($dir);
			return fopen($file,'a');
		}
	}
	public function errofWrite($type,$code,$msg){
		$times=date(DATE_ATOM);
		$errorMsg="[$times]".' '.$type."[$code]".$msg;
		$file=$this->openLog($errorMsg);
		fwrite($file,$errorMsg);
		fclose($file);
	}
}