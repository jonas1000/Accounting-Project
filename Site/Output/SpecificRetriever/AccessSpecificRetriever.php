<?php
function AccessFormSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAccessIndex, int $IniAvail)
{
	if(($IniAccessIndex > 0) &&
	CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0)) 
	{
		$rStatement = 0;

		$sQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM ".$InrConn->GetPrefix()."VIEW_ACCESS
		WHERE (ACCESS_AVAIL = ?
		AND (ACCESS_LEVEL >= ?)
        AND (ACCESS_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniAccessIndex))
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

function AccessSelectFormSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess, int &$IniAccessIndex, int &$IniAvail)
{
	if($IniAccessIndex > 0 &&
	CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0)) 
	{
		$rStatement = 0;

		$sQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_ACCESS
		WHERE (ACCESS_AVAIL = ?
		AND ACCESS_LEVEL >= ?)
        WHERE (ACCESS_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniAccessIndex))
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