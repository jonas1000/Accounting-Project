<?php
//-------------<FUNCTION>-------------//
function ProDelJobPIT(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['JobPITIndex']) && !empty($_POST['JobPITIndex']) && is_numeric($_POST['JobPITIndex']))
	{
		//variables consindered to be holding ID
		$iJobPITIndex = (int) $_POST['JobPITIndex'];
		
		if(($iJobPITIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			if(JobPITVisParser($InrConn, $InrLogHandle, $iJobPITIndex, $GLOBALS['AVAILABLE']['Hide']))
				$InrConn->Commit();
			else
				$InrConn->RollBack();
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);

		header("Location:Index.php?MenuIndex=" . $GLOBALS['MENU_INDEX']['Job']."&bIsSubOver=1");
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>