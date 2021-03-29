<?php
//-------------<FUNCTION>-------------//
function ProDelShareholder(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['ShareIndex']) && !empty($_POST['ShareIndex']) && is_numeric($_POST['ShareIndex']))
	{
		//variables consindered to be holding ID
		$iShareholderIndex = (int) $_POST['ShareIndex'];

		if(($iShareholderIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			if(ShareholderVisParser($InrConn, $InrLogHandle, $iShareholderIndex, $GLOBALS['AVAILABLE']['Hide']))
				$InrConn->Commit();
			else
				$InrConn->RollBack();
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);

		header("Location:Index.php?MenuIndex=" . $GLOBALS['MENU_INDEX']['Shareholder']);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>