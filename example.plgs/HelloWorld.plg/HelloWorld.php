<?php

class HelloWorld extends Plugin
{


	public function main ()
	{
		return 'Hello World!';
	}


	public static function getPlgInfo (): array
	{
		$plgInfo = array ();
		$plgInfo ['plgDescription'] = "Hello World plugin";
		$plgInfo ['isMenu'] = 1;
		$plgInfo ['perms'] = '[]';
		$plgInfo ['params'] = '[]';

		// Persmissions can't be nameless: that will be te node itself

		return $plgInfo;
	}
}