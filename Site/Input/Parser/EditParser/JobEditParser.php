<?php
function JobEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniCompanyIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobIndex) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "UPDATE
        ".$sPrefix."VIEW_JOB
        SET
        ".$sPrefix."VIEW_JOB.COMPANY_ID = ".$IniCompanyIndex.",
        ".$sPrefix."VIEW_JOB.ACCESS_LEVEL_ID = ".$IniContentAccessLevelIndex."
        WHERE
		(".$sPrefix."VIEW_JOB.JOB_ID = ".$IniJobIndex."
		AND
		".$sPrefix."VIEW_JOB.JOB_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_JOB.JOB_AVAIL = ".$IniIsAvailIndex.");";

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

function JobDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobDataIndex, string &$InsName, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InsName, $InsDate))
	{
		if(($IniJobDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE
            ".$sPrefix."VIEW_JOB_DATA
            SET
            ".$sPrefix."VIEW_JOB_DATA.JOB_DATA_Title = ".$InsName.",
            ".$sPrefix."VIEW_JOB_DATA.JOB_DATA_Date = ".$InsDate.",
            ".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS = ".$IniContentAccessLevelIndex."
            WHERE
			(".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ID = ".$IniJobDataIndex."
			AND
			".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS > ".($IniUserAccessLevelIndex - 1)."
			AND
			".$sPrefix."VIEW_JOB_DATA.JOB_DATA_AVAIL = ".$IniIsAvailIndex.");";

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

function JobIncomeEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobIncomeIndex, float &$InfPrice, float &$InfPIA, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
        ".$sPrefix."VIEW_JOB_INCOME
        SET
        ".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PRICE = ".(abs($InfPrice)).",
        ".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PIA = ".(abs($InfPIA)).",
        ".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS = ".$IniContentAccessLevelIndex."
        WHERE
		(".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ID = ".$IniJobIncomeIndex."
		AND
		".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_JOB_INCOME.JOB_INC_AVAIL = ".$IniIsAvailIndex.");";

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

function JobOutcomeEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobOutcomeIndex, float &$InfExpenses, float &$InfDamage, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobOutcomeIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
        ".$sPrefix."VIEW_JOB_OUTCOME
        SET
        ".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_EXP = ".(-abs($InfExpenses))",
        ".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_DAM = ".(-abs($InfDamage)).",
        ".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS = ".$IniContentAccessLevelIndex."
        WHERE
		(".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID = ".$IniJobOutcomeIndex."
		AND
		".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_AVAIL = ".$IniIsAvailIndex.");";

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