<?php
//-------------<FUNCTION>-------------//
function ProAddShareholder(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : bool
{
	if(isset($_POST['Employee'], $_POST['Access']) &&
	!ME_MultyCheckEmptyType($_POST['Employee'], $_POST['Access']) &&
	ME_MultyCheckNumericType($_POST['Employee'], $_POST['Access']))
	{
		//variables consindered to be holding ID
		$iEmployeeIndex = (int)$_POST['Employee'];
		$iContentAccess = (int)$_POST['Access'];

		//database cannot accept Primary or foreighn keys below 1
		//If duplicate the database will throw a exception
		if(($iEmployeeIndex > 0) && CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
		{
			if(ShareholderAddParser($InrConn, $InrLogHandle, $iEmployeeIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
				$InrLogHandle->AddLogMessage("ShareholderAddParser did not successfuly inserted the data", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>
