<?php
function JobEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniCompanyIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobIndex) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_JOB_EDIT
		SET
		".$sPrefix."VIEW_JOB_EDIT.COMP_ID = ".$IniCompanyIndex.",
		".$sPrefix."VIEW_JOB_EDIT.JOB_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_EDIT.JOB_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB_EDIT.JOB_ID = ".$IniJobIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

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

function JobDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobDataIndex, string &$InsName, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!ME_MultyCheckEmptyType($InsName, $InsDate))
	{
		if(($IniJobDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE
			".$sPrefix."VIEW_JOB_DATA_EDIT
			SET
			".$sPrefix."VIEW_JOB_DATA_EDIT.JOB_DATA_TITLE = \"".$InsName."\",
			".$sPrefix."VIEW_JOB_DATA_EDIT.JOB_DATA_ACCESS_ID = ".$IniContentAccessLevelIndex."
			WHERE
			(".$sPrefix."VIEW_JOB_DATA_EDIT.JOB_DATA_AVAIL_ID = ".$IniIsAvailIndex.")
			AND
			(".$sPrefix."VIEW_JOB_DATA_EDIT.JOB_DATA_ID = ".$IniJobDataIndex.");";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($sPrefix);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}

function JobIncomeEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobIncomeIndex, float &$InfPrice, float &$InfPIA, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_JOB_INCOME_EDIT
		SET
		".$sPrefix."VIEW_JOB_INCOME_EDIT.JOB_INC_PRICE = ".$InfPrice.",
		".$sPrefix."VIEW_JOB_INCOME_EDIT.JOB_INC_PIA = ".$InfPIA.",
		".$sPrefix."VIEW_JOB_INCOME_EDIT.JOB_INC_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME_EDIT.JOB_INC_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB_INCOME_EDIT.JOB_INC_ID = ".$IniJobIncomeIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

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

function JobOutcomeEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobOutcomeIndex, float &$InfExpenses, float &$InfDamage, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobOutcomeIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_JOB_OUTCOME_EDIT
		SET
		".$sPrefix."VIEW_JOB_OUTCOME_EDIT.JOB_OUT_EXPENSES = ".-abs($InfExpenses).",
		".$sPrefix."VIEW_JOB_OUTCOME_EDIT.JOB_OUT_DAMAGE = ".-abs($InfDamage).",
		".$sPrefix."VIEW_JOB_OUTCOME_EDIT.JOB_OUT_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_OUTCOME_EDIT.JOB_OUT_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB_OUTCOME_EDIT.JOB_OUT_ID = ".$IniJobOutcomeIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

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