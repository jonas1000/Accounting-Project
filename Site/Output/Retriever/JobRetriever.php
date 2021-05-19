<?php
function JobSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_Title";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_DATE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_Date";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_PRICE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_Price";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_PIA']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_PIA";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_EXPENSES']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_Expenses";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_DAMAGE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_Damage";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_COMPANY_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "COMPANY_DATA_Title";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "JOB_DATA_Title";
			break;
		}
	}
}

function JobRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;
		
		$sQuery = "SELECT
		JOB_ID,
		JOB_DATA_ID,
		JOB_INC_ID,
		JOB_OUT_ID,
		COMP_ID,
		JOB_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_JOB
		WHERE (JOB_AVAIL = ?)
		AND (JOB_ACCESS >= ?)
		ORDER BY JOB_ID DESC;";

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

function JobDataRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;
		
		$sQuery = "SELECT
		JOB_DATA_ID,
		JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_JOB_DATA
		WHERE (JOB_DATA_AVAIL = ?)
		AND (JOB_DATA_ACCESS >= ?)
		ORDER BY JOB_DATA_ID DESC;";

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

function JobIncomeRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;
		
		$sQuery = "SELECT
		JOB_INC_ID,
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_INC_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_JOB_INCOME
		WHERE (JOB_INC_AVAIL = ?)
		AND (JOB_INC_ACCESS >= ?)
		ORDER BY JOB_INC_ID DESC;";

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

function JobOutcomeRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;
		
		$sQuery = "SELECT
		JOB_OUT_ID,
		JOB_OUT_EXPENSES,
		JOB_OUT_DAMAGE,
		JOB_OUT_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_JOB_OUTCOME
		WHERE (JOB_OUT_AVAIL = ?)
		AND (JOB_OUT_ACCESS >= ?)
		ORDER BY JOB_OUT_ID DESC;";

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

function JobOverviewRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail, string &$InsSearchType="", string &$InsSearchQuery="")
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sSearchConstruction = "";
		$sSearchQuery = ME_SecDataFilter($InsSearchQuery);

		$rStatement = 0;

		JobSearchConstructor($sSearchConstruction, $InsSearchType);

		SearchQueryConstructor($sSearchQuery);

		$sQuery = "SELECT
		JOB_ID,
		JOB_DATA_ACCESS,
		JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_INC_ACCESS,
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_OUT_ACCESS,
		JOB_OUT_EXPENSES,
		JOB_OUT_DAMAGE,
		COMP_DATA_ACCESS,
		COMP_DATA_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_JOB_OVERVIEW
		WHERE (JOB_AVAIL = ?
		AND JOB_DATA_AVAIL = ?
		AND JOB_INC_AVAIL = ?
		AND JOB_OUT_AVAIL = ?
		AND COMP_DATA_AVAIL = ?)
		AND (JOB_ACCESS >= ?)
		AND (".$sSearchConstruction." LIKE ?)
		ORDER BY JOB_DATA_DATE DESC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiiiis", $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniUserAccess, $sSearchQuery))
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

function JobPITRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniJobIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		JOB_ID,
		JOB_PIT_ID,
		JOB_PIT_PAYMENT,
		JOB_PIT_ACCESS,
		JOB_PIT_DATE
		FROM ".$InrConn->GetPrefix()."VIEW_JOB_INCOME_TIME
		WHERE (JOB_PIT_AVAIL = ?
		AND JOB_PIT_ACCESS >= ?
		AND JOB_ID = ?)
		ORDER BY JOB_PIT_DATE DESC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniJobIndex))
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