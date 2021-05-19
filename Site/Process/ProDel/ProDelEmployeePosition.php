<?php
//-------------<FUNCTION>-------------//
function ProDelEmployeePosition(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['EmpPosIndex']) && !empty($_POST['EmpPosIndex']) && is_numeric($_POST['EmpPosIndex']))
	{
		//variables consindered to be holding ID
		$iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];

		//database cannot accept Primary or foreign keys below 1
		//If duplicate the database will throw a exception
		if(($iEmployeePositionIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			if(EmployeePositionVisParser($InrConn, $InrLogHandle, $iEmployeePositionIndex, $GLOBALS['AVAILABLE']['HIDE']))
				$InrConn->Commit();
			else
				$InrConn->RollBack();
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>