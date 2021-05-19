<?php
function JobPITAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobIndex, float $InfPIT, string &$InsDate, int $IniContentAccess, int $IniAvail) : bool
{
	if(!empty($InsDate) &&
	($IniJobIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fPIT = round((empty($InfPIT) ? 0 : $InfPIT), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);

		$sQuery="INSERT INTO ".$InrConn->GetPrefix()."VIEW_JOB_INCOME_TIME_ADD
		(JOB_ID,
		JOB_PIT_PAYMENT,
		JOB_PIT_DATE,
		JOB_PIT_ACCESS_ID,
		JOB_PIT_AVAIL_ID) 
		VALUES(?, ?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iisii", $IniJobIndex, $fPIT, $InsDate, $IniContentAccess, $IniAvail))				
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