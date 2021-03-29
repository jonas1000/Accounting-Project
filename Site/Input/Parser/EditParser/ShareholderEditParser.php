<?php
function ShareholderEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniShareholderIndex, int $IniEmployeeIndex, int $IniContentAccess, int $IniAvail)
{
	if(($IniEmployeeIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_SHAREHOLDER_EDIT
		SET 
		EMP_ID = ?,
		SHARE_ACCESS_ID = ?,
		SHARE_AVAIL_ID = ?
		WHERE 
		SHARE_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiii", $IniEmployeeIndex, $IniContentAccess, $IniAvail, $IniShareholderIndex))
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