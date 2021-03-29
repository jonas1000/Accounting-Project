<?php
function CountrySpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountryIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COUN_ID,
		COUN_DATA_ID,
		COUN_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTRY
		WHERE (COUN_AVAIL = ?)
		AND (COUN_ACCESS >= ?)
		AND (COUN_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCountryIndex))
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

function CountryDataSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryDataIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountryDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COUN_DATA_ID,
		COUN_DATA_TITLE,
		COUN_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTRY_DATA
		WHERE (COUN_DATA_AVAIL = ?)
		AND (COUN_DATA_ACCESS >= ?)
		AND (COUN_DATA_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCountryDataIndex))
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

//WARNIGN:To be removed in future versions
function CountryGeneralSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountryIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COUN_ID,
		COUN_AVAIL,
		COUN_ACCESS,
		COUN_DATA_ID,
		COUN_DATA_ACCESS,
		COUN_DATA_AVAIL,
		COUN_DATA_TITLE,
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTRY_GENERAL
		WHERE (COUN_AVAIL = ?
		AND COUN_DATA_AVAIL = ?)
		AND (COUN_ACCESS >= ?)
		AND (COUN_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiii", $IniAvail, $IniAvail, $IniUserAccess, $IniCountryIndex))
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

function CountryEditFormSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountryIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountryIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$rStatement = 0;

		$sQuery = "SELECT
		".$sPrefix."VIEW_COUNTRY.COUN_ID,
		".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS
		FROM ".$sPrefix."VIEW_COUNTRY, ".$sPrefix."VIEW_COUNTRY_DATA
		WHERE (".$sPrefix."VIEW_COUNTRY.COUN_AVAIL = ?
		AND ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL = ?)
		AND (".$sPrefix."VIEW_COUNTRY.COUN_ACCESS >= ?
		AND ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS >= ?)
		AND (".$sPrefix."VIEW_COUNTRY.COUN_ID = ?)
		AND (".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiii", $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniCountryIndex))
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