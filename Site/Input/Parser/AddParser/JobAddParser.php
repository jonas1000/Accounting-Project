<?php
function JobAddParser(ME_CDBConnManager &$InDBConn, int &$IniJobOutIndex, int &$IniJobIncIndex, int &$IniCompanyIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobOutIndex > 0) && ($IniJobIncIndex > 0) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		
		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_JOB_ADD
		(
		JOB_DATA_ID,
		JOB_OUT_ID,
		JOB_INC_ID,
		COMP_ID,
		JOB_ACCESS_ID,
		JOB_AVAIL_ID
		)
		VALUES
		(
		".$InDBConn->GetLastQueryID().",
		".$IniJobOutIndex.",
		".$IniJobIncIndex.",
		".$IniCompanyIndex.",
		".$IniContentAccessLevelIndex.",
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

function JobDataAddParser(ME_CDBConnManager &$InDBConn, string &$InsName, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!ME_MultyCheckEmptyType($InsName, $InsDate))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_JOB_DATA_ADD
			(
			JOB_DATA_TITLE,
			JOB_DATA_DATE,
			JOB_DATA_ACCESS_ID,
			JOB_DATA_AVAIL_ID
			)
			VALUES
			(
			\"".$InsName."\",
			\"".$InsDate."\" ,
			".$IniContentAccessLevelIndex.",
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

function JobIncomeAddParser(ME_CDBConnManager &$InDBConn, float &$InfPrice, float &$InfPIA, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_ADD
		(
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_INC_ACCESS_ID,
		JOB_INC_AVAIL_ID
		)
		VALUES
		(
		".((empty($InfPrice) || !is_numeric($InfPrice)) ? 0 : abs($InfPrice)).",
		".((empty($InfPIA) || !is_numeric($InfPIA))? 0 : abs($InfPIA)).",
		".$IniContentAccessLevelIndex.",
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

function JobOutcomeAddParser(ME_CDBConnManager &$InDBConn, float &$InfExpenses, float &$InfDamage, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_JOB_OUTCOME_ADD
		(
		JOB_OUT_EXPENSES,
		JOB_OUT_DAMAGE,
		JOB_OUT_ACCESS_ID,
		JOB_OUT_AVAIL_ID
		)
		VALUES
		(
		".((empty($InfExpenses) || !is_numeric($InfExpenses)) ? 0 : -(abs($InfExpenses))).",
		".((empty($InfDamage) || !is_numeric($InfDamage)) ? 0 : -(abs($InfDamage))).",
		".$IniContentAccessLevelIndex.",
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
?>