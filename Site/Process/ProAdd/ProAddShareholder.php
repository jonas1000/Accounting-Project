<?php
function ProAddShareholder(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Employee'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['Employee'], $_POST['Access']))
		{
			$sEmployee = $_POST['Employee'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sEmployee);
			ME_SecDataFilter($sAccess);

			$iEmployeeIndex = (int) $sEmployee;
			$iAccessIndex = (int) $sAccess;

			unset($sEmployee, $sAccess);

			ShareholderAddParser($InDBConn, $iEmployeeIndex, $iAccessIndex, $_ENV['Available']['Show']);

			unset($iEmployeeIndex, $iAccessIndex);
			unset($_POST['Employee'], $_POST['Access']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Shareholder']);
		}
		else
			throw new Exception("Missing POST data to complete transaction");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
