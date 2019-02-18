<?php
function HTMLJobAssigmentOver() : void
{
	require_once("../MedaLib/Class/Manager/DBConnManager.php");
}

SecFilterHTMLFormFunctionCallback("HTMLJobAssigmentOver", "Struct/Form/AddForm/AddJobAssigmentForm.php", $_ENV['AccessLevel']['CEO'], "GET", "Log");
?>
