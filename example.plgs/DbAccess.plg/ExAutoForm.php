<?php
include_once ('src/AutoForm.php');

class ExAutoForm extends Plugin
{
	private $jsonFile;
	const comboDta = array (1 => 'Pork', 22 => 'PLane');


	private function showNewForm ()
	{
		$retVal = '<h1>New Data Form</h1>';

		// We can select the order and wich fields we want to use to create
		$fieldSet = array ('fld1', 'fld2', 'fld3', 'fld5', 'fld9', 'fld0');
		if (isset ($_POST ['fld3']))
		{
			$autoForm = new AutoForm ($this->jsonFile);
			$autoForm->mysqli = $this->context->mysqli;
			$sql = $autoForm->getInsertSql ($_POST);

			$retVal .= "<b>SQL</b>: $sql<br />";

			if (! $this->context->mysqli->query ($sql))
			{
				$retVal .= 'Fail!!';
			}
			else
			{
				$retVal .= 'Success';
				// $resultado->close ();
			}
		}
		else
		{
			$retVal .= AutoForm::editJsonForm ($this->jsonFile, array (), $fieldSet);
		}

		return $retVal;
	}


	private function showRecords ()
	{
		$retVal = '<h1>Select row to edit</h1>';

		$sql = 'SELECT fldId, fld9 FROM ownTable LIMIT 10;';

		if (! $res = $this->context->mysqli->query ($sql))
		{
			$retVal .= 'Fail!!';
		}
		else
		{
			while ($row = $res->fetch_assoc ())
			{
				$retVal .= '<div>';

				$retVal .= '<span class="w-100">' . $row ['fld9'] . '</span>';
				$link = '?fldId=' . $row ['fldId'];
				$retVal .= '<a href="' . $link . '"><span class="w-50">Edit</span></a>';
				$retVal .= '</div>';
			}
		}
		return $retVal;
	}


	private function showEdit ()
	{
		if (isset ($_GET ['fldId']))
		{
			$retVal = '<h1>Updating record</h1>';
			if (isset ($_POST ['fldId']))
			{
				$autoForm = new AutoForm ($this->jsonFile);
				$autoForm->mysqli = $this->context->mysqli;
				$idxs = array ('fldId');
				$sql = $autoForm->getUpdateSql ($_POST, $idxs);

				$retVal .= "<b>SQL</b>: $sql<br />";

				if (! $res = $this->context->mysqli->query ($sql))
				{
					$retVal .= 'Fail!!';
				}
				else
				{
					$retVal .= 'Success';
					$retVal .= $this->showRecords ();
				}
			}
			else
			{
				$sql = 'SELECT * FROM ownTable WHERE fldId=' . $_GET ['fldId'] . ';';
				if (! $res = $this->context->mysqli->query ($sql))
				{
					$retVal .= 'Wrong ID';
				}
				else
				{
					if ($row = $res->fetch_assoc ())
					{
						$fieldSet = array ('fldId', 'fld2', 'fld9');

						$retVal .= AutoForm::editJsonForm ($this->jsonFile, $row, $fieldSet);
					}
					else
					{
						$retVal .= 'No record found';
					}
				}
			}
		}
		else
		{
			$retVal = $this->showRecords ();
		}

		return $retVal;
	}


	public function main ()
	{
		// We will work with this json
		$this->jsonFile = realpath (dirname (__FILE__)) . '/tables/customTable.jsonTable';

		// TODO: Finish this example
		// return 'Hello World!';
		return $this->showNewForm () . $this->showEdit ();
	}


	public function getExternalCss ()
	{
		$css = array ();
		$css [] = 'dbExample.css';
		return $css;
	}


	public static function getPlgInfo (): array
	{
		$plgInfo = array ();
		$plgInfo ['plgDescription'] = "Shows the use of the Helper AutoForm";
		$plgInfo ['isMenu'] = 1;
		$plgInfo ['perms'] = '[]';
		$plgInfo ['params'] = '[]';

		// Persmissions can't be nameless: that will be te node itself

		return $plgInfo;
	}
}