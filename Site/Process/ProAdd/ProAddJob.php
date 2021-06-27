<?php
//-------------<FUNCTION>-------------//
function ProAddJob(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	if(isset($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Access']) &&
	!ME_MultyCheckEmptyType($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Access']) &&
	ME_MultyCheckNumericType($_POST['Company'], $_POST['Access']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sName = ME_SecDataFilter($_POST['Name']);
		$sDate = ME_SecDataFilter($_POST['Date']);

		$fPrice = is_numeric($_POST['Price']) ? abs((float)$_POST['Price']) : 0;
		$fPIA = is_numeric($_POST['PIA']) ? abs((float)$_POST['PIA']) : 0;
		$fExpenses = is_numeric($_POST['Expenses']) ? -abs((float)$_POST['Expenses']) : 0;
		$fDamage = is_numeric($_POST['Damage']) ? -abs((float)$_POST['Damage']) : 0;

		//variables consindered to be holding ID
		$iCompanyIndex = (int)$_POST['Company'];
		$iContentAccess = (int)$_POST['Access'];	

		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(($fPrice >= 0.0) &&
		($fPIA >= 0.0) &&
		($fExpenses <= 0.0) &&
		($fDamage <= 0.0) &&
		($iCompanyIndex > 0) &&
		CheckAccessRange($iContentAccess) &&
		CheckAccessRange($IniUserAccess))
		{
			if(JobOutcomeAddParser($InrConn, $InrLogHandle, $fExpenses, $fDamage, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
			{
				$iOutcomeLastIndex = $InrConn->GetLastInsertID();

				if(JobIncomeAddParser($InrConn, $InrLogHandle, $fPrice, $fPIA, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
				{
					$iIncomeLastIndex = $InrConn->GetLastInsertID();

					if(JobDataAddParser($InrConn, $InrLogHandle, $sName, $sDate, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
					{
						$iDataLastIndex = $InrConn->GetLastInsertID();

						if(JobAddParser($InrConn, $InrLogHandle, $iDataLastIndex, $iOutcomeLastIndex, $iIncomeLastIndex, $iCompanyIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
							$InrLogHandle->AddLogMessage("JobAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);

							if(!$InrConn->RollBack())
								throw new exception("Failed to rollback data");
						}
					}
					else
					{
						$InrLogHandle->AddLogMessage("JobDataAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);

						if(!$InrConn->RollBack())
							throw new exception("Failed to rollback data");
					}
				}
				else
				{
					$InrLogHandle->AddLogMessage("JobIncomeAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);

					if(!$InrConn->RollBack())
						throw new exception("Failed to rollback data");
				}
			}
			else
				$InrLogHandle->AddLogMessage("OutcomeAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>
