<?php
//-------------<FUNCTION>-------------//
function ProAddEmployeePosition(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	if(isset($_POST['Name'], $_POST['Access']) &&
	!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Access']) &&
	is_numeric($_POST['Access']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sName = ME_SecDataFilter($_POST['Name']);
		
		//variables consindered to be holding ID
		$iContentAccess = (int)$_POST['Access'];

		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
		{
			if(EmployeePositionAddParser($InrConn, $InrLogHandle, $sName, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
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
				$InrLogHandle->AddLogMessage("EmployeePositionAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>
