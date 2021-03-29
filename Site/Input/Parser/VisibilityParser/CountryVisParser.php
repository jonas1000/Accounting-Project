<?php
function CountryVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryIndex, int $IniAvail)
{
	if(($IniCountryIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_COUNTRY_VISIBILITY
		SET
		".$sPrefix."VIEW_COUNTRY_VISIBILITY.COUN_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_COUNTRY_VISIBILITY.COUN_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniCountryIndex))
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

function CountryDataVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryDataIndex, int $IniAvail)
{
	if(($IniCountryDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY.COUN_DATA_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY.COUN_DATA_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniCountryDataIndex))
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