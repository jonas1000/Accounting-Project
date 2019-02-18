<?php
function EmployeeAddParser(CDBConnManager &$InDBConn, int &$IniPositionIndex, int &$IniCompanyIndex, int $IniAccessIndex, int $IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniPositionIndex, $IniCompanyIndex, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniPositionIndex > 0) && ($IniCompanyIndex > 0) && ($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$DBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE
			(
			EMP_DATA_ID,
			EMP_POS_ID,
			COMP_ID,
			EMP_ACCESS,
			EMP_AVAIL
			)
			VALUES
			(
			".$InDBConn->GetLastQueryID().",
			".$IniPositionIndex.",
			".$IniCompanyIndex.",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($DBQuery, TRUE);

			//detect and print if any error has been detected in query
			if(!$InDBConn->HasError())
			{
					if($InDBConn->HasWarning())
						throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($DBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}

function EmployeeDataAddParser(CDBConnManager &$InDBConn, string &$InsName, string &$InsSurname, string &$InsPassword, string &$InsEmail, float &$InfSalary, string &$InsBDay, string &$InsPhoneNumber, string &$InsStableNumber, int &$IniAccessIndex, int &$IniIsAvailIndex, int &$IniPasswordCost=10) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsName, $InsSurname, $InsPassword, $InsEmail, $InsBDay, $IniAccessIndex, $IniIsAvailIndex, $IniPasswordCost))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			//database Query
			$DBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_DATA
			(
			EMP_DATA_NAME,
			EMP_DATA_SURNAME,
			EMP_DATA_PASS,
			EMP_DATA_EMAIL,
			EMP_DATA_SAL,
			EMP_DATA_BDAY,
			EMP_DATA_PN,
			EMP_DATA_SN,
			EMP_DATA_ACCESS,
			EMP_DATA_AVAIL
			)
			VALUES
			(
			\"".$InsName."\",
			\"".$InsSurname."\",
			\"".password_hash($InsPassword, PASSWORD_BCRYPT, ["cost" => $IniPasswordCost])."\",
			\"".$InsEmail."\",
			".((empty($InfSalary) || ($InfSalary < 0)) ? 0 : $InfSalary).",
			\"".$InsBDay."\",
			\"".(empty($InsPhoneNumber) ? "None" : $InsPhoneNumber)."\",
			\"".(empty($InsStableNumber) ? "None" : $InsStableNumber)."\",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($DBQuery, TRUE);

			//detect and throw if any error has been detected in query
			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($DBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>
