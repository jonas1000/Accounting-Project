<?php
function JobAddParser(CDBConnManager &$InDBConn, int &$IniJobOutIndex, int &$IniJobIncIndex, int &$IniCompanyIndex, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniJobOutIndex, $IniJobIncIndex, $IniCompanyIndex, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniJobOutIndex > 0) && ($IniJobIncIndex > 0) && ($IniCompanyIndex > 0) && ($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_JOB
			(
			JOB_DATA_ID,
			JOB_OUT_ID,
			JOB_INC_ID,
			COMP_ID,
			JOB_ACCESS,
			JOB_AVAIL
			)
			VALUES
			(
			".$InDBConn->GetLastQueryID().",
			".$IniJobOutIndex.",
			".$IniJobIncIndex.",
			".$IniCompanyIndex.",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

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

function JobDataAddParser(CDBConnManager &$InDBConn, string &$InsName, string &$InsDate, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsName, $InsDate, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_JOB_DATA
			(
			JOB_DATA_TITLE,
			JOB_DATA_DATE,
			JOB_DATA_ACCESS,
			JOB_DATA_AVAIL
			)
			VALUES
			(
			\"".$InsName."\",
			\"".$InsDate."\" ,
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}

function JobIncomeAddParser(CDBConnManager &$InDBConn, float &$InfPrice, float &$InfPIA, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_JOB_INCOME
			(
			JOB_INC_PRICE,
			JOB_INC_PIA,
			JOB_INC_ACCESS,
			JOB_INC_AVAIL
			)
			VALUES
			(
			".(empty($InfPrice) ? 0 : abs($InfPrice)).",
			".(empty($InfPIA) ? 0 : abs($InfPIA)).",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

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

function JobOutcomeAddParser(CDBConnManager &$InDBConn, float &$InfExpenses, float &$InfDamage, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_JOB_OUTCOME
			(
			JOB_OUT_EXP,
			JOB_OUT_DAM,
			JOB_OUT_ACCESS,
			JOB_OUT_AVAIL
			)
			VALUES
			(
			".(empty($InfExpenses) ? 0 : -(abs($InfExpenses))).",
			".(empty($InfDamage) ? 0 : -(abs($InfDamage))).",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

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
