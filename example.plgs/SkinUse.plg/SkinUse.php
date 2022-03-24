<?php

class SkinUse extends Plugin
{


	public function main ()
	{
		//TODO: Finish this example
		return 'Hello World!';
	}
	
	public function getExternalCss ()
	{
		$css = array ();
		$css [] = 'accounts.css';
		return $css;
	}


	public static function getPlgInfo (): array
	{
		$plgInfo = array ();
		$plgInfo ['plgDescription'] = "Plugin wich uses skins and js";
		$plgInfo ['isMenu'] = 1;
		$plgInfo ['perms'] = '[]';
		$plgInfo ['params'] = '[]';

		// Persmissions can't be nameless: that will be te node itself

		return $plgInfo;
	}
}