<?php
function EmployeeEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeIndex, int $IniEmployeePositionIndex, int $IniCompanyIndex, int $IniContentAccess, int $IniAvail)
{
	if(($IniEmployeePositionIndex > 0) &&
	($IniCompanyIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_EDIT
		SET 
		EMP_POS_ID = ?,
		COMP_ID = ?,
		EMP_ACCESS_ID = ?,
		EMP_AVAIL_ID = ?
		WHERE 
		EMP_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiiii", $IniEmployeePositionIndex, $IniCompanyIndex, $IniContentAccess, $IniAvail, $IniEmployeeIndex))
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

function EmployeeDataEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeDataIndex, string &$InsName, string &$InsSurname, string &$InsEmail, float $InfSalary, string &$InsBDay, string &$InsPhoneNumber, string &$InsStableNumber, int $IniContentAccess, int $IniAvail)
{
	if(!ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPhoneNumber, $InsBDay) &&
	($IniEmployeeDataIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sStableNumber = (empty($InsStableNumber) ? "None" : $InsStableNumber);
		$sEmail = (empty($InsEmail) ? "null" : $InsEmail);
		
		//database Query
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_DATA_EDIT
		SET
		EMP_DATA_SALARY = ?,
		EMP_DATA_BDAY = ?,
		EMP_DATA_PN = ?,
		EMP_DATA_SN = ?,
		EMP_DATA_EMAIL = ?,
		EMP_DATA_NAME = ?,
		EMP_DATA_SURNAME = ?,
		EMP_DATA_ACCESS_ID = ?,
		EMP_DATA_AVAIL_ID = ?
		WHERE 
		EMP_DATA_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("dssssssiii", $InfSalary, $InsBDay, $InsPhoneNumber, $sStableNumber, $sEmail, $InsName, $InsSurname, $IniContentAccess, $IniAvail, $IniEmployeeDataIndex))
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