<?php
function ProAddCustomer(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($InDBConn, $_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber']))
		{
			$sName = $_POST['Name'];
			$sSurname = $_POST['Surname'];
			$sPN = $_POST['PhoneNumber'];
			$sSN = $_POST['StableNumber'];
			$sEmail = $_POST['Email'];
			$sVAT = $_POST['VAT'];
			$sAddr = $_POST['Addr'];
			$sNote = $_POST['Note'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sName);
			ME_SecDataFilter($sSurname);
			ME_SecDataFilter($sPN);
			ME_SecDataFilter($sSN);
			ME_SecDataFilter($sEmail);
			ME_SecDataFilter($sVAT);
			ME_SecDataFilter($sAddr);
			ME_SecDataFilter($sNote);
			ME_SecDataFilter($sAccess);

			$iAccessIndex = (int) $sAccess;

			unset($sAccess);

			CustomerDataAddParser($InDBConn, $sName, $sSurname, $sPN, $sSN, $sEmail, $sVAT, $sAddr, $sNote, $iAccessIndex, $_ENV['Available']['Show']);

			if($InDBConn->GetLastQueryID())
				CustomerAddParser($InDBConn, $iAccessIndex, $_ENV['Available']['Show']);
			else
				throw new Exception("Error: Failed to get the id of last query");

			unset($sName, $sSurname, $sPN, $sSN, $sEmail, $sVAT, $sAddr, $sNote, $iAccessIndex);
			unset($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Customer']);
		}
		else
			throw new Exception("Missing POST data to complete transaction");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
