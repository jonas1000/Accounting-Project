<?php
function EmployeeEditParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniEmployeePositionIndex, int &$IniCompanyIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniEmployeePositionIndex > 0) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && ($IniIsAvailIndex < (count($_ENV['Available']) + 1))))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "UPDATE
        ".$sPrefix."VIEW_EMPLOYEE
        SET
        ".$sPrefix."VIEW_EMPLOYEE.COMP_ID = ".$IniCompanyIndex.",
        ".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID = ".$IniEmployeePositionIndex.",
        ".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS = ".$IniContentAccessLevelIndex."
        WHERE
		(".$sPrefix."VIEW_EMPLOYEE.EMP_ID = ".$IniEmployeeIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL = ".$IniIsAvailIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		//detect and print if any error has been detected in query
		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function EmployeeDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeeDataIndex, string &$InsName, string &$InsSurname, string &$InsEmail, float &$InfSalary, string &$InsBDay, string &$InsPhoneNumber, string &$InsStableNumber, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPhoneNumber, $InsBDay))
	{
		if(($IniEmployeeDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && ($IniIsAvailIndex < count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();
			
			//database Query
			$sDBQuery = "UPDATE
            ".$sPrefix."VIEW_EMPLOYEE_DATA
            SET
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME = \"".$InsName."\",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME = \"".$InsSurname."\",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL = \"".(empty($InsEmail) ? "NULL" : $InsEmail)."\",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SAL = ".abs($InfSalary).",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY = \"".$InsBDay."\",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN = \"".$InsPhoneNumber."\",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN = \"".(empty($InsStableNumber) ? "NULL" : $InsStableNumber)."\",
            ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS = ".$IniContentAccessLevelIndex."
            WHERE
			(".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID = ".$IniEmployeeDataIndex."
			AND
			".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS > ".($IniUserAccessLevelIndex - 1)."
			AND
			".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL = ".$IniIsAvailIndex.");";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			//detect and throw if any error has been detected in query
			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($sDBQuery, $sPrefix);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>