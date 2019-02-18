<?php
function ProDelCountry(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['CounIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['CounIndex']))
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/CountryVisParser.php");
			
			$sCounIndex = $_POST['CounIndex'];

			ME_SecDataFilter($sCounIndex);

			$iCounIndex = (int) $sCounIndex;

			unset($sCounIndex);

			CountryVisParser($InDBConn, $iCounIndex, $_ENV['Available']['Hide']);

			unset($iCounIndex);
			unset($_POST['CounIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Country']);
		}
	}
}
?>