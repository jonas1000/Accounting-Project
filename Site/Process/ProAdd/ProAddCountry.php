<?php
function ProAddCountry(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['Name'], $_POST['Access']))
		{
			$sTitle = $_POST['Name'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sTitle);
			ME_SecDataFilter($sAccess);

			$iAccessIndex = (int) $sAccess;

			unset($sAccess);

			CountryDataAddParser($InDBConn, $sTitle, $iAccessIndex, $_ENV['Available']['Show']);

			if($InDBConn->GetLastQueryID())
				CountryAddParser($InDBConn, $iAccessIndex, $_ENV['Available']['Show']);
			else
				throw new Exception("Error: Failed to get the id of last query");

			unset($sTitle, $iAccessIndex);
			unset($_POST['Name'], $_POST['Access']);

			header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Country']);
		}
		else
			throw new Exception("Some POST data are NULL, Those POST cannot be NULL");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
