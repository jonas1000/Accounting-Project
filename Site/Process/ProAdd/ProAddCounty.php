<?php
function ProAddCounty(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Date'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['Name'], $_POST['Date'], $_POST['Access']))
		{
			$sTitle = $_POST['Name'];
			$sTax = $_POST['Tax'];
			$sInterestRate = $_POST['IR'];
			$sDate = $_POST['Date'];
			$sCountry = $_POST['Country'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sTitle);
			ME_SecDataFilter($sTax);
			ME_SecDataFilter($sInterestRate);
			ME_SecDataFilter($sDate);
			ME_SecDataFilter($sCountry);
			ME_SecDataFilter($sAccess);

			$fTax = (float) $sTax;
			$fInterestRate = (float) $sInterestRate;
			$iCountryIndex = (int) $sCountry;
			$iAccessIndex = (int) $sAccess;

			unset($sTax, $sInterestRate, $sCountry, $sAccess);

			CountyDataAddParser($InDBConn, $sTitle, $fTax, $fInterestRate, $sDate, $iAccessIndex, $_ENV['Available']['Show']);

			if($InDBConn->GetLastQueryID())
				CountyAddParser($InDBConn, $iCountryIndex, $iAccessIndex, $_ENV['Available']['Show']);
			else
				throw new Exception("Failed to get the id of last query");

			unset($sTitle, $fTax, $fInterestRate, $sDate, $iCountryIndex, $iAccessIndex);
			unset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Date'], $_POST['Country'], $_POST['Access']);

			header("Location:.?MenuIndex=".$_ENV['MenuIndex']['County']);
		}
		else
			throw new Exception("Some POST data are NULL, Those POST cannot be NULL");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
