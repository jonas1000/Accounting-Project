<?php
function EmployeePositionVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeePositionIndex, int $IniAvail)
{
	if(($IniEmployeePositionIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_EMPLOYEE_POSITION
		SET
		".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = ?
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniEmployeePositionIndex))
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