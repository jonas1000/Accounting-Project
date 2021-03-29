<?php
function EmployeePositionEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeePositionIndex, string &$InsName, int $IniContentAccess, int $IniAvail)
{
	if(!empty($InsName) &&
	($IniEmployeePositionIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_POSITION_EDIT
		SET 
		EMP_POS_TITLE = ?,
		EMP_POS_ACCESS_ID = ?,
		EMP_POS_AVAIL_ID = ?
		WHERE 
		EMP_POS_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("siii", $InsName, $IniContentAccess, $IniAvail, $IniEmployeePositionIndex))
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>