<?php
function EmployeeSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniEmployeeIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_EMPLOYEE.EMP_ID,
		".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID,
		".$sPrefix."VIEW_EMPLOYEE.COMP_ID,
		".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID,
		".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS
		FROM
		".$sPrefix."VIEW_EMPLOYEE
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS > ".($IniUserAccessLevel - 1).")
		AND
		(".$sPrefix."VIEW_EMPLOYEE.EMP_ID = ".$IniEmployeeIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function EmployeeDataSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeeDataIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniEmployeeDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN,
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_EMPLOYEE_DATA
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS > ".($IniUserAccessLevel - 1).")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID = ".$IniEmployeeDataIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function EmployeeGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniEmployeeIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		$iUserAccessLevelIndex = ($IniUserAccessLevel - 1);

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
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_DATA_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_POS_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COMP_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COMP_DATA_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COU_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COU_DATA_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COUN_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.COUN_DATA_ACCESS > ".$iUserAccessLevelIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ID = ".$IniEmployeeIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $iUserAccessLevelIndex);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function EmployeePositionSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniEmployeePositionIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
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
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS > ".($IniUserAccessLevel - 1)."
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

function EmployeeLoginRetriever(ME_CDBConnManager &$InDBConn, string &$InsEmail, int &$IniIsAvailIndex) : void
{
	if(($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		EMP_ID,
		EMP_ACCESS,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_PASS
		FROM
		".$sPrefix."VIEW_EMPLOYEE_LOGIN
		WHERE
		".$sPrefix."VIEW_EMPLOYEE_LOGIN.EMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_LOGIN.EMP_DATA_EMAIL = \"".$InsEmail."\";";

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

function EmployeeEditFormSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniEmployeeIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		$iUserAccessLevel = ($IniUserAccessLevel - 1);

		$sDBQuery = "SELECT
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
		FROM
		".$sPrefix."VIEW_EMPLOYEE,
		".$sPrefix."VIEW_EMPLOYEE_DATA
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS > ".$iUserAccessLevel."
		AND
		".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS > ".$iUserAccessLevel.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID)
		AND
		(".$sPrefix."VIEW_EMPLOYEE.EMP_ID = ".$IniEmployeeIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix, $iUserAccessLevel);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}
?>