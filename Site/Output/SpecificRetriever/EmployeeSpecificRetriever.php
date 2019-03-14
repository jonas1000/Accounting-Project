<?php
function EmployeeGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniEmployeePositionIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT 
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
		EMP_DATA_PASS, 
		EMP_DATA_BDAY, 
		EMP_DATA_PN, 
		EMP_DATA_SN,
		EMP_POS_ID,
		EMP_POS_ACCESS, 
		EMP_POS_AVAIL, 
		EMP_POS_TITLE, 
		COMP_ID 
		FROM 
		".$sPrefix."VIEW_EMPLOYEE_GENERAL 
		WHERE 
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_POS_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COU_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COU_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COUN_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_DATA_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_POS_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COMP_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COMP_DATA_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COU_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COU_DATA_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COUN_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COUN_DATA_ACCESS > ".$IniUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ID = ".$IniEmployeePositionIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function EmployeePositionSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniEmployeePositionIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		EMP_POS_ID,
		EMP_POS_TITLE,
		EMP_POS_ACCESS
		FROM
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_ID = ".$IniEmployeePositionIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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
?>