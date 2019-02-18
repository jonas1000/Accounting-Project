<?php
function ProDelCustomer(CDBConnManager &$InDBConn) : void
{
	if(isset($_POST['CustIndex']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['CustIndex']))
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/CustomerVisParser.php");

			$sCustIndex = $_POST['CustIndex'];

			ME_SecDataFilter($sCustIndex);

			$iCustIndex = (int) $sCustIndex;

			unset($sCustIndex);

			VisCustomerParser($InDBConn, $iCustIndex, $_ENV['Available']['Hide']);

			unset($iCustIndex);
			unset($_POST['CustIndex']);

			header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Customer']);
		}
	}
}
?>