<?php
function ProDelCounty(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['CouIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['CouIndex']))
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/CountyVisParser.php");

			$sCouIndex = $_POST['CouIndex'];

			ME_SecDataFilter($sCouIndex);

			$iCouIndex = (int) $sCouIndex;

			unset($sCouIndex);

			CountyVisParser($InDBConn, $iCouIndex, $_ENV['Available']['Hide']);

			unset($iCouIndex);
			unset($_POST['CouIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['County']);
		}
	}
}
?>