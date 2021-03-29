<?php
function AccessSelectElemRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM
		".$InrConn->GetPrefix()."VIEW_ACCESS
		WHERE (ACCESS_AVAIL = ?)
		AND	(ACCESS_LEVEL >= ?)
		ORDER BY ACCESS_LEVEL ASC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("ii", $IniAvail, $IniUserAccess))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
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

function AccessSelectFormRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniAvail > 0 && ($IniAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE'])))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM
		".$InrConn->GetPrefix()."VIEW_ACCESS
		WHERE (ACCESS_AVAIL = ?)
		AND	(ACCESS_LEVEL >= ?)
		ORDER BY ACCESS_LEVEL ASC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("ii", $IniAvail, $IniUserAccess))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
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