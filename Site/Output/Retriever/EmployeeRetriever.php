<?php
function EmployeeRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		ORDER BY EMP_ID DESC;";

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

function EmployeeDataRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		ORDER BY EMP_DATA_ID DESC;";

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

function EmployeeGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
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
		FROM
		".$sPrefix."VIEW_EMPLOYEE_GENERAL
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function EmployeeOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
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
		FROM
		".$sPrefix."VIEW_EMPLOYEE_OVERVIEW
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_OVERVIEW.EMP_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_OVERVIEW.EMP_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY EMP_ID DESC;";

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

function EmployeePositionOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		EMP_POS_ID,
		EMP_POS_ACCESS,
		EMP_POS_TITLE
		FROM
		".$sPrefix."VIEW_EMPLOYEE_POSITION_OVERVIEW
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_POSITION_OVERVIEW.EMP_POS_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_POSITION_OVERVIEW.EMP_POS_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY EMP_POS_ID DESC;";

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

function EmployeeSelectElemRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		EMP_ID,
		EMP_DATA_NAME
		FROM
		".$sPrefix."VIEW_EMPLOYEE_GENERAL
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_POS_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY EMP_ID DESC;";

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

function EmployeeEditFormRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		EMP_ID,
		EMP_DATA_NAME
		FROM
		".$sPrefix."VIEW_EMPLOYEE_GENERAL
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_POS_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY EMP_ID DESC;";

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

function EmployeePosSelectElemRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		EMP_POS_ID,
		EMP_POS_TITLE
		FROM
		".$sPrefix."VIEW_EMPLOYEE_POSITION
		WHERE
		".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS > ".($IniUserAccessLevel - 1).";";

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
?>