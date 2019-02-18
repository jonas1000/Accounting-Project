<?php
function ProAddJobPIT(CDBConnManager &$InDBConn)
{
	if(isset($_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['JobIndex'], $_POST['Date'], $_POST['Access']))
		{
			$sJob = $_POST['JobIndex'];
			$sPayment = $_POST['PIT'];
			$sDate = $_POST['Date'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sJob);
			ME_SecDataFilter($sPayment);
			ME_SecDataFilter($sDate);
			ME_SecDataFilter($sAccess);

			$fPayment = (float) $sPayment;
			$iJobIndex = (int) $sJob;
			$iAccessIndex = (int) $sAccess;

			unset($sPayment, $sJob, $sAccess);

			JobPitAddParser($InDBConn, $iJobIndex, $fPayment, $sDate, $iAccessIndex, $_ENV['Available']['Show']);

			unset($iJobIndex, $fPayment, $sDate, $iAccessIndex);
			unset($_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Job']);
		}
		else
			throw new Exception("Missing POST data to complete transaction");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
