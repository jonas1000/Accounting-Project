<?php
//TODO: Create assigment module for users(CEO, managers etc) can assign employees to jobs.

function HTMLJobAssigmentOver() : void
{
	require_once("../MedaLib/Class/Manager/DBConnManager.php");
}

SecFilterHTMLFormFunctionCallback("HTMLJobAssigmentOver", "Struct/Form/AddForm/AddJobAssigmentForm.php", $GLOBALS['ACCESS']['CEO'], "GET", "Log");
?>
