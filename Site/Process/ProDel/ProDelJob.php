<?php
function ProDelJob(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['JobIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['JobIndex']))
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/JobVisParser.php");

			$sJobIndex = $_POST['JobIndex'];

			ME_SecDataFilter($sJobIndex);

			$iJobIndex = (int) $sJobIndex;

			unset($sJobIndex);

			JobVisParser($InDBConn, $iJobIndex, $_ENV['Available']['Hide']);

			unset($iJobIndex);
			unset($_POST['JobIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Job']);
		}
	}
}
?>