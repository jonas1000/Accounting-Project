<?php
function JobVisParser(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_JOB_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_VISIBILITY.JOB_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_VISIBILITY.JOB_ID = ".$IniJobIndex.");";

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

function JobDataVisParser(ME_CDBConnManager &$InDBConn, int &$IniJobDataIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_JOB_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_DATA_VISIBILITY.JOB_DATA_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_DATA_VISIBILITY.JOB_DATA_ID = ".$IniJobDataIndex.");";

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

function JobIncomeVisParser(ME_CDBConnManager &$InDBConn, int &$IniJobIncomeIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobIncomeIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_JOB_INCOME_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_INCOME_VISIBILITY.JOB_INC_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME_VISIBILITY.JOB_INC_ID = ".$IniJobIncomeIndex.");";

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

function JobOutcomeVisParser(ME_CDBConnManager &$InDBConn, int &$IniJobOutcomeIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobOutcomeIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY.JOB_OUT_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY.JOB_OUT_ID = ".$IniJobOutcomeIndex.");";

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