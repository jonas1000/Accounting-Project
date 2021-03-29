<?php
function JobPITEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobPITIndex, float $InfPIT, string &$InsDate, int $IniContentAccess, int $IniAvail)
{
	if(!empty($InsDate) &&
	($IniJobPITIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fPIT = round((empty($InfPIT) ? 0 : $InfPIT), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);

		$sQuery="UPDATE ".$InrConn->GetPrefix()."VIEW_JOB_INCOME_TIME_EDIT
		SET 
		JOB_PIT_PAYMENT = ?,
		JOB_PIT_DATE = ?,
		JOB_PIT_ACCESS_ID = ?,
		JOB_PIT_AVAIL_ID = ?
		WHERE 
		JOB_PIT_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("dsiii", $fPIT, $InsDate, $IniContentAccess, $IniAvail, $IniJobPITIndex))
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