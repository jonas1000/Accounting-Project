<?php
function CompanySpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompanyIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCompanyIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COMP_ID,
		COMP_DATA_ID,
		COU_ID,
		COMP_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_COMPANY
		WHERE (COMP_AVAIL = ?)
		AND (COMP_ACCESS >= ?)
		AND (COMP_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCompanyIndex))
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

function CompanyDataSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompanyDataIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCompanyDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COMP_DATA_ID,
		COMP_DATA_TITLE,
		COMP_DATA_DATE,
		COMP_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_COMPANY_DATA
		WHERE (COMP_DATA_AVAIL = ?)
		AND (COMP_DATA_ACCESS >= ?)
		AND (COMP_DATA_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCompanyDataIndex))
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
function CompanyGeneralSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCompIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		COMP_ID,
		COMP_ACCESS,
		COMP_AVAIL,
		COU_ID,
		COMP_DATA_ID,
		COMP_DATA_ACCESS,
		COMP_DATA_AVAIL,
		COMP_DATA_TITLE,
		COMP_DATA_DATE,
		COUN_DATA_TITLE,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COU_DATA_DATE
		FROM ".$InrConn->GetPrefix()."VIEW_COMPANY_GENERAL
		WHERE (COMP_AVAIL = ?
		AND COMP_DATA_AVAIL = ?)
		AND (COMP_ACCESS >= ?)
		AND (COMP_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiii", $IniAvail, $IniAvail, $IniUserAccess, $IniCompIndex))
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

function CompanyEditFormSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompanyIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCompanyIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$rStatement = 0;

		$sQuery = "SELECT
		".$sPrefix."VIEW_COMPANY.COMP_ID,
		".$sPrefix."VIEW_COMPANY.COU_ID,
		".$sPrefix."VIEW_COMPANY.COMP_ACCESS,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS
		FROM ".$sPrefix."VIEW_COMPANY, ".$sPrefix."VIEW_COMPANY_DATA
		WHERE (".$sPrefix."VIEW_COMPANY.COMP_AVAIL = ?
		AND	".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ?)
		AND	(".$sPrefix."VIEW_COMPANY.COMP_ACCESS >= ?
		AND	".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS >= ?)
		AND	(".$sPrefix."VIEW_COMPANY.COMP_ID = ?
		AND	".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiii", $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniCompanyIndex))
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