<?php
//-------------<FUNCTION>-------------//
function ProAddCustomer(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	var_dump($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']);
	if(isset($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']) &&
	!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['Access']) &&
	ME_MultyCheckNumericType($_POST['Access'], $_POST['PhoneNumber'], $_POST['StableNumber']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sName = ME_SecDataFilter($_POST['Name']);
		$sSurname = ME_SecDataFilter($_POST['Surname']);
		$sPN = ME_SecDataFilter($_POST['PhoneNumber']);
		$sSN = ME_SecDataFilter($_POST['StableNumber']);
		$sEmail = ME_SecDataFilter($_POST['Email']);
		$sVAT = ME_SecDataFilter($_POST['VAT']);
		$sAddr = ME_SecDataFilter($_POST['Addr']);
		$sNote = ME_SecDataFilter($_POST['Note']);

		//variables consindered to be holding ID
		$iContentAccess = (int)$_POST['Access'];

		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(CheckAccessRange($iContentAccess) &&	CheckAccessRange(($IniUserAccess)))
		{
			if(CustomerDataAddParser($InrConn, $InrLogHandle, $sName, $sSurname, $sPN, $sSN, $sEmail, $sVAT, $sAddr, $sNote, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
			{
				$iCustomerDataLastIndex = $InrConn->GetLastInsertID();

				if(CustomerAddParser($InrConn, $InrLogHandle, $iCustomerDataLastIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
				{
					if($InrConn->Commit())
						return TRUE;
					else
					{
						$InrLogHandle->AddLogMessage("Failed to Commit data", __FILE__, __FUNCTION__, __LINE__);

						if(!$InrConn->RollBack())
							throw new exception("Failed to rollback data");
					}
				}
				else
				{
					$InrLogHandle->AddLogMessage("CountryAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);

					if(!$InrConn->RollBack())
						throw new exception("Failed to rollback data");
				}
			}
			else
				$InrLogHandle->AddLogMessage("CountryDataAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>
