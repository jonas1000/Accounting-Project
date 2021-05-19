<?php
//-------------<FUNCTION>-------------//
function ProAddEmployee(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	if(isset($_POST['Name'], $_POST['Surname'], $_POST['Pass'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Access'], $_POST['Company'], $_POST['EmployeePosition']) &&
	!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Surname'], $_POST['Pass'], $_POST['Email'], $_POST['BDay'], $_POST['PN'], $_POST['Access'], $_POST['Company'], $_POST['EmployeePosition']) &&
	ME_MultyCheckNumericType($_POST['Access'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['PN'], $_POST['SN'], $_POST['Salary']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sName = ME_SecDataFilter($_POST['Name']);
		$sSurname = ME_SecDataFilter($_POST['Surname']);
		$sPassword = ME_SecDataFilter($_POST['Pass']);
		$sEmail = ME_SecDataFilter($_POST['Email']);
		$sBDay = ME_SecDataFilter($_POST['BDay']);
		$sPhoneNumber = ME_SecDataFilter($_POST['PN']);
		$sStableNumber = ME_SecDataFilter($_POST['SN']);

		$fSalary = (float)$_POST['Salary'];

		//variables consindered to be holding ID
		$iContentAccess = (int)$_POST['Access'];
		$iCompanyIndex = (int)$_POST['Company'];
		$iEmployeePositionIndex = (int)$_POST['EmployeePosition'];

		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(($fSalary >= 0.0) &&
		CheckAccessRange($iContentAccess) &&
		($iCompanyIndex > 0) &&
		($iEmployeePositionIndex > 0) &&
		CheckAccessRange($IniUserAccess))
		{
			if(EmployeeDataAddParser($InrConn, $InrLogHandle, $sName, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
			{
				$iEmployeeDataLastIndex = $InrConn->GetLastInsertID();

				if(EmployeeAddParser($InrConn, $InrLogHandle, $iEmployeeDataLastIndex, $iEmployeePositionIndex, $iCompanyIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
					$InrLogHandle->AddLogMessage("EmployeeAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);

					if(!$InrConn->RollBack())
						throw new exception("Failed to rollback data");
				}
			}
			else
				$InrLogHandle->AddLogMessage("EmployeeDataAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>
