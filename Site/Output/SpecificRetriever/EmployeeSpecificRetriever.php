<?php
function EmployeeSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniEmployeeIndex > 0) &&
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
		AND (EMP_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniEmployeeIndex))
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

function EmployeeDataSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeDataIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniEmployeeDataIndex > 0) &&
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
		AND (EMP_DATA_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniEmployeeDataIndex))
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
function EmployeeGeneralSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniEmployeeIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT 
		EMP_ID,
		EMP_ACCESS, 
		EMP_AVAIL, 
		EMP_DATA_ID,
		EMP_DATA_ACCESS, 
		EMP_DATA_AVAIL, 
		EMP_DATA_SALARY, 
		EMP_DATA_EMAIL, 
		EMP_DATA_NAME, 
		EMP_DATA_SURNAME,
		EMP_DATA_BDAY, 
		EMP_DATA_PN, 
		EMP_DATA_SN,
		EMP_POS_ID,
		EMP_POS_ACCESS, 
		EMP_POS_AVAIL, 
		EMP_POS_TITLE, 
		COMP_ID 
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL 
		WHERE (EMP_AVAIL = ?
		AND EMP_DATA_AVAIL = ?
		AND EMP_POS_AVAIL = ?
		AND COMP_AVAIL = ?
		AND COMP_DATA_AVAIL = ?
		AND COU_AVAIL = ?
		AND COU_DATA_AVAIL = ?
		AND COUN_AVAIL = ?
		AND COUN_DATA_AVAIL = ?
		AND EMP_ACCESS >= ?
		AND EMP_DATA_ACCESS >= ?
		AND EMP_POS_ACCESS >= ?
		AND COMP_ACCESS >= ?
		AND COMP_DATA_ACCESS >= ?
		AND COU_ACCESS >= ?
		AND COU_DATA_ACCESS >= ?
		AND COUN_ACCESS >= ?
		AND COUN_DATA_ACCESS >= ?
		AND EMP_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiiiiiiiiiiiiiiiiii", $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniEmployeeIndex))
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

function EmployeePositionSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeePositionIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniEmployeePositionIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_POS_ID,
		EMP_POS_TITLE,
		EMP_POS_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
		WHERE (EMP_POS_AVAIL = ?
		AND EMP_POS_ACCESS >= ?
		AND EMP_POS_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniEmployeePositionIndex))
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

function EmployeeLoginRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsEmail, int $IniAvail)
{
	if(!empty($InsEmail) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		EMP_ID,
		EMP_ACCESS,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_PASS
		FROM ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_LOGIN
		WHERE EMP_AVAIL = ?
		AND EMP_DATA_EMAIL = ?;";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("is", $IniAvail, $InsEmail))
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

function EmployeeEditFormSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniEmployeeIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$rStatement = 0;

		$sQuery = "SELECT
		".$sPrefix."VIEW_EMPLOYEE.EMP_ID,
		".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID,
		".$sPrefix."VIEW_EMPLOYEE.COMP_ID,
		".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS
		FROM ".$sPrefix."VIEW_EMPLOYEE, ".$sPrefix."VIEW_EMPLOYEE_DATA
		WHERE (".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL = ?
		AND ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL = ?)
		AND (".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS >= ?
		AND ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS >= ?)
		AND (".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID)
		AND (".$sPrefix."VIEW_EMPLOYEE.EMP_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiii", $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniEmployeeIndex))
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