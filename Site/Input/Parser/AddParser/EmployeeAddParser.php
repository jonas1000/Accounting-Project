<?php
function EmployeeAddParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, int &$IniCompanyIndex, int $IniContentAccessLevelIndex, int $IniIsAvailIndex) : void
{
	if(($IniEmployeePositionIndex > 0) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		
		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_ADD
		(
		EMP_DATA_ID,
		EMP_POS_ID,
		COMP_ID,
		EMP_ACCESS_ID,
		EMP_AVAIL_ID
		)
		VALUES
		(
		".$InDBConn->GetLastQueryID().",
		".$IniEmployeePositionIndex.",
		".$IniCompanyIndex.",
		".$IniContentAccessLevelIndex.",
		".$IniIsAvailIndex."
		);";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		//detect and print if any error has been detected in query
		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function EmployeeDataAddParser(ME_CDBConnManager &$InDBConn, string &$InsName, string &$InsSurname, string &$InsPassword, string &$InsEmail, float &$InfSalary, string &$InsBDay, string &$InsPhoneNumber, string &$InsStableNumber, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex, int &$IniPasswordCost=10) : void
{
	if(!ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPassword, $InsEmail, $InsBDay))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)) && ($IniPasswordCost > 0))
		{
			$sDBQuery = "";
			
			//database Query
			$$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_DATA_ADD
			(
			EMP_DATA_NAME,
			EMP_DATA_SURNAME,
			EMP_DATA_PASS,
			EMP_DATA_EMAIL,
			EMP_DATA_SALARY,
			EMP_DATA_BDAY,
			EMP_DATA_PN,
			EMP_DATA_SN,
			EMP_DATA_ACCESS_ID,
			EMP_DATA_AVAIL_ID
			)
			VALUES
			(
			\"".$InsName."\",
			\"".$InsSurname."\",
			\"".password_hash($InsPassword, PASSWORD_BCRYPT, ["cost" => $IniPasswordCost])."\",
			\"".$InsEmail."\",
			".$InfSalary.",
			\"".$InsBDay."\",
			\"".(empty($InsPhoneNumber) ? "None" : $InsPhoneNumber)."\",
			\"".(empty($InsStableNumber) ? "None" : $InsStableNumber)."\",
			".$IniContentAccessLevelIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($$sDBQuery, TRUE);

			//detect and throw if any error has been detected in query
			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($$sDBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>