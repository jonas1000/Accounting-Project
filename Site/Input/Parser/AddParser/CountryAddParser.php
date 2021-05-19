<?php
//-------------<FUNCTION>-------------//
function CountryAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryDataIndex, int $IniContentAccess, int $IniAvail) : bool
{
	if(($IniCountryDataIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		//The query string to be binded by the statement
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_COUNTRY_ADD
		(COUN_DATA_ID,
		COUN_ACCESS_ID,
		COUN_AVAIL_ID) 
		VALUES(?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iii", $IniCountryDataIndex, $IniContentAccess, $IniAvail))
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

function CountryDataAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsTitle, int $IniContentAccess, int $IniAvail) : bool
{
	if(!empty($InsTitle) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		//The query string to be binded by the statement
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_COUNTRY_DATA_ADD
		(COUN_DATA_TITLE,
		COUN_DATA_ACCESS_ID,
		COUN_DATA_AVAIL_ID)
		VALUES(?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("sii", $InsTitle, $IniContentAccess, $IniAvail))
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