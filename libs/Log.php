<?php
namespace libs;

use libs\Config;

class Log{

	/**
	 * 打开当日日志
	 * @return Resource
	 */
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

	/**
	 * 写入错误日志
	 * @param string $type
	 * @param string $code
	 * @param string $msg
	 * @return Boolean
	 */
	public function errofWrite($type,$code,$msg){
		$times=date(DATE_ATOM);
		$errorMsg="[$times]".' '.$type."[$code]".$msg;
		$file=$this->openLog($errorMsg);
		$res=fwrite($file,$errorMsg);
		fclose($file);
		if($res){
			return true;
		}
		else{
			return false;
		}
	}
}