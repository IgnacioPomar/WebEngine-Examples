<?php

class PersmissionsAndParameters extends Plugin
{


	public function main ()
	{

		// Now, we can use all of those params
		return $this->header () . $this->showPerms () . $this->showParams ();
	}


	public static function getPlgInfo (): array
	{
		$plgInfo = array ();
		$plgInfo ['plgDescription'] = "PLugin showing plugin functions.";
		$plgInfo ['isMenu'] = 1;
		$plgInfo ['perms'] = '["seeAll","otherResource"]';
		$plgInfo ['params'] = '[{"name":"fontColor","type":"color","defaultValue":"#ffaacc"},{"name":"name","type":"string","defaultValue":"Mr. Smith"}]';

		return $plgInfo;
	}


	private function header ()
	{
		return '';
	}


	private function showPerms ()
	{
		$retVal = '<h1>Persmissions</h1>';

		foreach ($this->perms as $permName => $permValue)
		{
			if ($permName === '') continue; // Is the Menu node itself
			$val = $permValue ? 'true' : 'false';
			$retVal .= "<p><b>$permName</b>: $val</p>";
		}

		$retVal .= '<h2>Example of use</h2>';
		if ($this->perms ['seeAll'])
		{
			$retVal .= '<p>We are allowed to see all the content</p>';
		}
		else
		{
			$retVal .= ''; // Show error code?
		}

		if ($this->perms ['otherResource'])
		{
			$retVal .= '<p>We have access to otherResource</p>';
		}
		else
		{
			$retVal .= '<p>We <b>DON\'T</b> have access to otherResource</p>';
		}

		return $retVal;
	}


	private function showParams ()
	{
		$retVal = '<h1>Params</h1>';

		foreach ($this->params as $paramName => $paramValue)
		{
			$retVal .= "<p><b>$paramName</b>: $paramValue</p>";
		}

		$retVal .= '<h2>Example of use</h2>';
		$retVal .= '<p style="color: ' . $this->params ['fontColor'] . '">Hello ' . $this->params ['name'] . '</p>';

		return $retVal;
	}
}