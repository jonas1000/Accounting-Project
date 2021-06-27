<?php
function ShareholderSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_NAME']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_SURNAME']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SURNAME";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_EMAIL']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_EMAIL";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_BIRTH_DATE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_BDAY";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_POSITION_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_POS_TITLE";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_SALARY']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SALARY";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}
	}
}

function ShareholderRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		SHARE_ID,
		EMP_ID,
		SHARE_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_SHAREHOLDER
		WHERE (SHARE_AVAIL = ?)
		AND (SHARE_ACCESS >= ?)
		ORDER BY SHARE_ID DESC;";

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

function ShareholderOverviewRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail, string &$InsSearchType="", string &$InsSearchQuery="")
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sSearchConstruction = "";
		$sSearchQuery = ME_SecDataFilter($InsSearchQuery);

		$rStatement = 0;

		ShareholderSearchConstructor($sSearchConstruction, $InsSearchType);

		SearchQueryConstructor($sSearchQuery);

		$sQuery = "SELECT
		SHARE_ID,
		EMP_DATA_ACCESS,
		EMP_DATA_SALARY,
		EMP_DATA_BDAY,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_EMAIL,
		EMP_POS_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_SHAREHOLDER_OVERVIEW
		WHERE (SHARE_AVAIL = ?
		AND EMP_DATA_AVAIL = ?
		AND EMP_POS_AVAIL = ?)
		AND (SHARE_ACCESS >= ?)
		AND (".$sSearchConstruction." LIKE ?)
		ORDER BY SHARE_ID DESC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiis", $IniAvail, $IniAvail, $IniAvail, $IniUserAccess, $sSearchQuery))
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