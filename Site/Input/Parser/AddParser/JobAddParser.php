<?php
function JobAddParser(ME_CDBConnManager &$InDBConn, int &$IniJobOutIndex, int &$IniJobIncIndex, int &$IniCompanyIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobOutIndex > 0) && ($IniJobIncIndex > 0) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		
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
	if(ME_MultyCheckEmptyType($InsName, $InsDate))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

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
		".$InDBConn->GetPrefix()."VIEW_JOB_OUTCOME
		(
		JOB_OUT_EXP,
		JOB_OUT_DAM,
		JOB_OUT_ACCESS,
		JOB_OUT_AVAIL
		)
		VALUES
		(
		".-(abs($InfExpenses).",
		".-(abs($InfDamage).",
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