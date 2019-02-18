<?php
function ProAddCompany(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']))
		{
			$sName = $_POST['Name'];
			$sDate = $_POST['Date'];
			$sAccess = $_POST['Access'];
			$sCounty = $_POST['County'];

			ME_SecDataFilter($sName);
			ME_SecDataFilter($sDate);
			ME_SecDataFilter($sAccess);
			ME_SecDataFilter($sCounty);

			$iAccessIndex = (int) $sAccess;
			$iCountyIndex = (int) $sCounty;

			unset($sAccess, $sCounty);

			CompanyDataAddParser($InDBConn, $sName, $sDate, $iAccessIndex, $_ENV['Available']['Show']);

			if($InDBConn->GetLastQueryID())
				CompanyAddParser($InDBConn, $iCountyIndex, $iAccessIndex, $_ENV['Available']['Show']);
			else
				throw new Exception("Coulnd't get last query id");

			unset($sName, $sDate, $iAccessIndex, $iCountyIndex);
			unset($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Company']);
		}
		else
			throw new Exception("Some POST data are NULL, Those POST cannot be NULL");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
