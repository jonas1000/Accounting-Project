<?php
//-------------<FUNCTION>-------------//
function ProAddJobPIT(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	if(isset($_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']) &&
	!ME_MultyCheckEmptyType($_POST['JobIndex'], $_POST['Date'], $_POST['Access']) &&
	ME_MultyCheckNumericType($_POST['JobIndex'], $_POST['Access'], $_POST['PIT']))
	{
		//format the string to be compatible with HTML and avoid SQL injection
		$sDate = ME_SecDataFilter($_POST['Date']);

		$fPayment = is_numeric($_POST['PIT']) ? abs((float)$_POST['PIT']) : 0;

		//variables consindered to be holding ID
		$iJobIndex = (int)$_POST['JobIndex'];
		$iContentAccess = (int)$_POST['Access'];

		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(($fPayment >= 0.0) && ($iJobIndex > 0) && CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
		{
			if(JobPitAddParser($InrConn, $InrLogHandle, $iJobIndex, $fPayment, $sDate, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
				$InrLogHandle->AddLogMessage("JobPitAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>
