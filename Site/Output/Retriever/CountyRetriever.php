<?php
function CountySearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['COUNTY_SEARCH_TYPE']['COUNTY_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "COU_DATA_TITLE";
			break;
		}

		case $GLOBALS['COUNTY_SEARCH_TYPE']['COUNTY_TAX']["NAME"]:
		{
			$InsSearchTypeQuery = "COU_DATA_TAX";
			break;
		}

		case $GLOBALS['COUNTY_SEARCH_TYPE']['COUNTY_IR']["NAME"]:
		{
			$InsSearchTypeQuery = "COU_DATA_IR";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "COU_DATA_TITLE";
			break;
		}
	}
}

function CountyRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COU_ID,
		COU_DATA_ID,
		COUN_ID,
		COU_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTY
		WHERE (COU_AVAIL = ?)
		AND	(COU_ACCESS >= ?);";

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

function CountyDataRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "SELECT
		COU_DATA_ID,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COU_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTY_DATA
		WHERE (COU_DATA_AVAIL = ?)
		AND	(COU_DATA_ACCESS >= ?);";

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

function CountyGeneralRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COU_ID,
		COU_ACCESS,
		COU_AVAIL,
		COU_DATA_ACCESS,
		COU_DATA_AVAIL,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COU_DATA_DATE
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTY_GENERAL
		WHERE (COU_AVAIL = ?
		AND	COU_DATA_AVAIL = ?)
		AND	(COU_ACCESS >= ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniAvail, $IniUserAccess))
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

function CountyOverviewRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail, string &$InsSearchType="", string &$InsSearchQuery="")
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sSearchConstruction = "";
		$sSearchQuery = ME_SecDataFilter($InsSearchQuery);

		$rStatement = 0;

		CountySearchConstructor($sSearchConstruction, $InsSearchType);

		SearchQueryConstructor($sSearchQuery);

		$sQuery = "SELECT
		COU_ID,
		COU_DATA_ACCESS,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTY_OVERVIEW
		WHERE (COU_AVAIL = ?
		AND	COU_DATA_AVAIL = ?)
		AND	(COU_ACCESS >= ?)
		AND	".$sSearchConstruction." LIKE ?;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiis", $IniAvail, $IniAvail, $IniUserAccess, $sSearchQuery))
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

function CountySelectElemRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniAvail > 0 && $IniAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COU_ID,
		COU_DATA_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_COUNTY_OVERVIEW
		WHERE (COU_AVAIL = ?
		AND	COU_DATA_AVAIL = ?)
		AND	(COU_ACCESS >= ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniAvail, $IniUserAccess))
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