<?php
function CustomerSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_NAME']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_Name";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_SURNAME']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_Surname";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_PHONE']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_PN";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_STABLE']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_SN";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_EMAIL']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_Email";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_VAT']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_VAT";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "CUST_DATA_Name";
			break;
		}
	}
}

function CustomerRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		CUST_ID,
		CUST_DATA_ID,
		CUST_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER
		WHERE (CUST_AVAIL = ?)
		AND (CUST_ACCESS >= ?);";

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

function CustomerDataRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		CUST_DATA_ID,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_EMAIL,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE,
		CUST_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER_DATA
		WHERE (CUST_DATA_AVAIL = ?)
		AND (CUST_DATA_ACCESS >= ?);";

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

function CustomerGeneralRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		CUST_ID,
		CUST_DATA_ACCESS,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_EMAIL,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER_GENERAL
		WHERE (CUST_AVAIL = ?)
		AND (CUST_ACCESS >= ?);";

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

function CustomerOverviewRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail, string &$InsSearchType="", string &$InsSearchQuery="")
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sSearchConstruction = "";
		$sSearchQuery = ME_SecDataFilter($InsSearchQuery);

		$rStatement = 0;

		CustomerSearchConstructor($sSearchConstruction, $InsSearchType);

		SearchQueryConstructor($sSearchQuery);

		$sQuery = "SELECT
		CUST_ID,
		CUST_DATA_ACCESS,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_EMAIL,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER_OVERVIEW
		WHERE (CUST_AVAIL = ?
		AND	CUST_ACCESS >= ?)
		AND	(".$sSearchConstruction." LIKE ?)
		ORDER BY CUST_ID DESC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iis", $IniAvail, $IniUserAccess, $sSearchQuery))
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