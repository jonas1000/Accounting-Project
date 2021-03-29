<?php
function JobPITVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobPitIndex, int $IniAvail)
{
	if(($IniJobPitIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY.JOB_PIT_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY.JOB_PIT_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniJobPitIndex))
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