<?php
//-------------<FUNCTION>-------------//
function ProDelJob(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
	if(isset($_POST['JobIndex']) && !empty($_POST['JobIndex']) && is_numeric($_POST['JobIndex']))
	{
		//variables consindered to be holding ID
		$iJobIndex = (int) $_POST['JobIndex'];

		if(($iJobIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			$rResult = JobSpecificRetriever($InrConn, $InrLogHandle, $iJobIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

			if(!empty($rResult) && ($rResult->num_rows == 1))
			{
				$aDataRow = $rResult->fetch_assoc();

				if(JobVisParser($InrConn, $InrLogHandle, $iJobIndex, $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
					$InrConn->RollBack();

				if(JobDataVisParser($InrConn, $InrLogHandle, $aDataRow['JOB_DATA_ID'], $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
					$InrConn->RollBack();

				if(JobIncomeVisParser($InrConn, $InrLogHandle, $aDataRow['JOB_INC_ID'], $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
					$InrConn->RollBack();

				if(JobOutcomeVisParser($InrConn, $InrLogHandle, $aDataRow['JOB_OUT_ID'], $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
					$InrConn->RollBack();

				$rResult->free();
			}
			else
				$InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);

		header("Location:Index.php?MenuIndex=" . $GLOBALS['MENU_INDEX']['Job']);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>