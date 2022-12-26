<?php
namespace app\command;

use libs\console\Command;


class test extends Command{

	public function handle()
	{
		echo $this->args[0] ?? 'hello word';
	}
}