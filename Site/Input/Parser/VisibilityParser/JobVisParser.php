<?php
function JobVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobIndex, int $IniAvail)
{
	if(($IniJobIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_JOB_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_VISIBILITY.JOB_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_JOB_VISIBILITY.JOB_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniJobIndex))
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

function JobDataVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobDataIndex, int $IniAvail)
{
	if(($IniJobDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_JOB_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_DATA_VISIBILITY.JOB_DATA_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_JOB_DATA_VISIBILITY.JOB_DATA_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniJobDataIndex))
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

function JobIncomeVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobIncomeIndex, int $IniAvail)
{
	if(($IniJobIncomeIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_JOB_INCOME_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_INCOME_VISIBILITY.JOB_INC_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME_VISIBILITY.JOB_INC_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniJobIncomeIndex))
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

function JobOutcomeVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobOutcomeIndex, int $IniAvail)
{
	if(($IniJobOutcomeIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY.JOB_OUT_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY.JOB_OUT_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniJobOutcomeIndex))
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