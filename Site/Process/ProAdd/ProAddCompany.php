<?php
//-------------<FUNCTION>-------------//
function ProAddCompany(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	if(isset($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']) &&
	!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']) &&
	ME_MultyCheckNumericType($_POST['Access'], $_POST['County']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sName = ME_SecDataFilter($_POST['Name']);
		$sDate = ME_SecDataFilter($_POST['Date']);

		//variables consindered to be holding ID
		$iContentAccess = (int)$_POST['Access'];
		$iCountyIndex = (int)$_POST['County'];

		if(CheckAccessRange($iContentAccess) && ($iCountyIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			//if the function failed to insert data, then do not continue as the rest of the block as it will not work
			if(CompanyDataAddParser($InrConn, $InrLogHandle, $sName, $sDate, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
			{
				$iLastIndexCompanyData = $InrConn->GetLastInsertID();

				if(CompanyAddParser($InrConn, $InrLogHandle, $iLastIndexCompanyData, $iCountyIndex, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
				{
					//Check if the data where commited, else throw a exception
					if($InrConn->Commit())
						return TRUE;
					else
					{
						$InrLogHandle->AddLogMessage("Failed to commit", __FILE__, __METHOD__, __LINE__);

						if(!$InrConn->Rollback())
							throw new exception("Failed to rollback after errors");
					}
				}
				else
				{
					$InrLogHandle->AddLogMessage("CompanyAddParser did not successfuly inserted the data", __FILE__, __METHOD__, __LINE__);

					if(!$InrConn->Rollback())
						throw new exception("Failed to rollback after errors");
				}
			}
			else
				$InrLogHandle->AddLogMessage("Failed to parse data in data table", __FILE__, __METHOD__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __METHOD__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __METHOD__, __LINE__);

	return FALSE;
}
?>