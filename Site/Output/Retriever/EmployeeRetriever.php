<?php
function EmployeeGeneralRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = NULL;

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
			".$DBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL
			WHERE
			".$DBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$DBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($IniAccessIndex - 1).";";

			$DBConn->ExecQuery($sDBQuery, FALSE);

			if(!$DBConn->HasError())
			{
				if($DBConn->HasWarning())
					throw new Exception($DBConn->GetWarning());
			}
			else
				throw new Exception($DBConn->GetError());

			unset($sDBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}

function EmployeeOverviewRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			EMP_ID,
			EMP_ACCESS,
			EMP_AVAIL,
			EMP_DATA_SAL,
			EMP_DATA_EMAIL,
			EMP_DATA_NAME,
			EMP_DATA_SURNAME,
			EMP_DATA_BDAY,
			EMP_DATA_PN,
			EMP_DATA_SN,
			EMP_POS_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($IniAccessIndex - 1).";";

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
	else
		throw new Exception("Input parameters are empty");
}

function EmployeePositionRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			EMP_POS_ID,
			EMP_POS_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS > ".($IniAccessIndex - 1).";";

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
	else
		throw new Exception("Input parameters are empty");
}

function EmployeeFormRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			EMP_ID,
			EMP_DATA_NAME
			FROM
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_DATA_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_POS_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($IniAccessIndex - 1).";";

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
	else
		throw new Exception("Input parameters are empty");
}

function EmployeePosFormRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			EMP_POS_ID,
			EMP_POS_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS > ".($IniAccessIndex - 1).";";

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
	else
		throw new Exception("Input parameters are empty");
}

function EmployeeLoginRetriever(CDBConnManager &$InDBConn, string &$InsEmail, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsEmail, $IniIsAvailIndex))
	{
		if(($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			EMP_ID,
			EMP_ACCESS,
			EMP_DATA_NAME,
			EMP_DATA_SURNAME,
			EMP_DATA_PASS
			FROM
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_LOGIN
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_LOGIN.EMP_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_LOGIN.EMP_DATA_EMAIL = \"" . $InsEmail . "\";";

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
	else
		throw new Exception("Input parameters are empty");
}
?>