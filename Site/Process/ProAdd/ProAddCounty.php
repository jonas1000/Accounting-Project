<?php
//-------------<FUNCTION>-------------//
function ProAddCounty(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	var_dump($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Access']);
	if(isset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Access']) &&
	!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Access']) &&
	ME_MultyCheckNumericType($_POST['Country'], $_POST['Access'], $_POST['Tax'], $_POST['IR']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sTitle = ME_SecDataFilter($_POST['Name']);

		$fTax = (float)$_POST['Tax'];
		$fIR = (float)$_POST['IR'];

		//variables consindered to be holding ID
		$iCountryIndex = (int)$_POST['Country'];
		$iContentAccess = (int)$_POST['Access'];

		//Limit data to a certain acceptable range
		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(CheckRange($fTax, 100.0, 0.0) &&
		CheckRange($fIR, 100.0, 0.0) &&
		($iCountryIndex > 0) &&
		CheckAccessRange($iContentAccess) &&
		CheckAccessRange($IniUserAccess))
		{
			if(CountyDataAddParser($InrConn, $InrLogHandle, $sTitle, $fTax, $fIR, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
			{
				$iLastIndexCountyData = $InrConn->GetLastInsertID();

				if(CountyAddParser($InrConn, $InrLogHandle, $iLastIndexCountyData, $iCountryIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
