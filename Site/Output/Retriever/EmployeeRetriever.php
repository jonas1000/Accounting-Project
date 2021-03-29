<?php
function EmployeeSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Name']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Surname']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SURNAME";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Phone']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_PN";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Stable']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SN";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Email']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_EMAIL";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Salary']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SALARY";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_Title']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_TITLE";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['Employee_BirthDay']["name"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_BDAY";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}
	}
}

function EmployeePosSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['EMPLOYEE_POSITION_SEARCH_TYPE']['Employee_Position_Title']["name"]:
		{
			$InsSearchTypeQuery = "EMP_POS_TITLE";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "EMP_POS_TITLE";
			break;
		}
	}
}

function EmployeeRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_ID,
		EMP_POS_ID,
		COMP_ID,
		EMP_DATA_ID,
		EMP_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE
		WHERE (EMP_AVAIL = ?)
		AND (EMP_ACCESS >= ?)
		ORDER BY EMP_ID DESC;";

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

function EmployeeDataRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_DATA_ID,
		EMP_DATA_SALARY,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_EMAIL,
		EMP_DATA_BDAY,
		EMP_DATA_PN,
		EMP_DATA_SN,
		EMP_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_DATA
		WHERE (EMP_DATA_AVAIL = ?)
		AND (EMP_DATA_ACCESS >= ?)
		ORDER BY EMP_DATA_ID DESC;";

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

function EmployeeGeneralRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_ID,
		EMP_ACCESS,
		EMP_AVAIL,
		EMP_DATA_ACCESS,
		EMP_DATA_AVAIL,
		EMP_DATA_SAL,
		EMP_DATA_EMAIL,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_PASS,
		EMP_DATA_BDAY,
		EMP_DATA_PN,
		EMP_DATA_SN,
		EMP_POS_ACCESS,
		EMP_POS_AVAIL,
		EMP_POS_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL
		WHERE (EMP_AVAIL = ?)
		AND (EMP_ACCESS >= ?);";

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

function EmployeeOverviewRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail, string &$InsSearchType="", string &$InsSearchQuery="")
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sSearchConstruction = "";
		$sSearchQuery = ME_SecDataFilter($InsSearchQuery);

		$rStatement = 0;

		EmployeeSearchConstructor($sSearchConstruction, $InsSearchType);

		SearchQueryConstructor($sSearchQuery);

		$sQuery = "SELECT
		EMP_ID,
		EMP_DATA_ACCESS,
		EMP_DATA_SALARY,
		EMP_DATA_EMAIL,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_BDAY,
		EMP_DATA_PN,
		EMP_DATA_SN,
		EMP_POS_ACCESS,
		EMP_POS_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_OVERVIEW
		WHERE (EMP_AVAIL = ?)
		AND (EMP_ACCESS >= ?)
		AND (".$sSearchConstruction." LIKE ?)
		ORDER BY EMP_ID DESC;";

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

function EmployeePositionOverviewRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail, string &$InsSearchType="", string &$InsSearchQuery="")
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sSearchConstruction = "";
		$sSearchQuery = ME_SecDataFilter($InsSearchQuery);

		$rStatement = 0;

		EmployeePosSearchConstructor($sSearchConstruction, $InsSearchType);

		SearchQueryConstructor($sSearchQuery);

		$sQuery = "SELECT
		EMP_POS_ID,
		EMP_POS_ACCESS,
		EMP_POS_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_POSITION_OVERVIEW
		WHERE (EMP_POS_AVAIL = ?)
		AND (EMP_POS_ACCESS >= ?)
		AND (".$sSearchConstruction." LIKE ?)
		ORDER BY EMP_POS_ID DESC;";

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

function EmployeeSelectElemRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_ID,
		EMP_DATA_NAME
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL
		WHERE (EMP_AVAIL = ?
		AND EMP_DATA_AVAIL = ?
		AND EMP_POS_AVAIL = ?)
		AND (EMP_ACCESS >= ?)
		ORDER BY EMP_ID DESC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiii", $IniAvail, $IniAvail, $IniAvail, $IniUserAccess))
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

function EmployeeEditFormRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_ID,
		EMP_DATA_NAME
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL
		WHERE (EMP_AVAIL = ?
		AND EMP_DATA_AVAIL = ?
		AND EMP_POS_AVAIL = ?)
		AND (EMP_ACCESS >= ?)
		ORDER BY EMP_ID DESC;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiii", $IniAvail, $IniAvail, $IniAvail, $IniUserAccess))
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

function EmployeePosSelectElemRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_POS_ID,
		EMP_POS_TITLE
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
		WHERE (EMP_POS_AVAIL = ?)
		AND (EMP_POS_ACCESS >= ?);";

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