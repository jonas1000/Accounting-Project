<?php
function ProAddEmployeePosition(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['Name'], $_POST['Access']))
		{
			$sName = $_POST['Name'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sName);
			ME_SecDataFilter($sAccess);

			$iAccessIndex = (int) $sAccess;

			unset($sAccess);

			EmployeePositionAddParser($InDBConn, $sName, $iAccessIndex, $_ENV['Available']['Show']);

			unset($sName, $iAccessIndex);
			unset($_POST['Name'], $_POST['Access']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['EmployeePosition']);
		}
		else
			throw new Exception("Missing POST data to complete transaction");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
