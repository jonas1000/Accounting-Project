<?php
function EmployeeAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniEmployeeDataIndex, int $IniEmployeePositionIndex, int $IniCompanyIndex, int $IniContentAccess, int $IniAvail) : bool
{
	if(($IniEmployeeDataIndex > 0) &&
	($IniEmployeePositionIndex > 0) &&
	($IniCompanyIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_ADD
		(EMP_POS_ID,
		EMP_DATA_ID,
		COMP_ID,
		EMP_ACCESS_ID,
		EMP_AVAIL_ID) 
		VALUES(?, ?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiiii", $IniEmployeePositionIndex, $IniEmployeeDataIndex, $IniCompanyIndex, $IniContentAccess, $IniAvail))
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

function EmployeeDataAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsName, string &$InsSurname, string &$InsPassword, string &$InsEmail, float $InfSalary, string &$InsBDay, string &$InsPhoneNumber, string &$InsStableNumber, int $IniContentAccess, int $IniAvail, int $IniPasswordCost=10) : bool
{
	if(!ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPassword, $InsEmail, $InsBDay) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0) &&
	($IniPasswordCost > 5))
	{
		$sPasswordHash = password_hash($InsPassword, PASSWORD_BCRYPT, ["cost" => $IniPasswordCost]);

		$sPhoneNumber = (empty($InsPhoneNumber) ? "None" : $InsPhoneNumber);
		$sStableNumber = (empty($InsStableNumber) ? "None" : $InsStableNumber);
		
		//database Query
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_EMPLOYEE_DATA_ADD
		(EMP_DATA_SALARY,
		EMP_DATA_BDAY,
		EMP_DATA_PN,
		EMP_DATA_SN,
		EMP_DATA_EMAIL,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_PASS,
		EMP_DATA_ACCESS_ID,
		EMP_DATA_AVAIL_ID) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("dsssssssii", $InfSalary, $InsBDay, $sPhoneNumber, $sStableNumber, $InsEmail, $InsName, $InsSurname, $sPasswordHash, $IniContentAccess, $IniAvail))
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query" , __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>