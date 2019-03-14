<?php
function JobGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevelIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		JOB_ID,
		JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_INC_ID,
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_OUT_ID,
		JOB_OUT_EXP,
		JOB_OUT_DAM,
		COMP_DATA_TITLE,
		COMP_DATA_DATE
		FROM
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_INC_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_OUT_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.COMP_DATA_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function JobOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevelIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		JOB_ID,
		JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_OUT_EXP,
		JOB_OUT_DAM,
		COMP_DATA_TITLE
		FROM
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_INC_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_OUT_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

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

function JobPitRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if($IniJobIndex > 0 && $IniUserAccessLevelIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		JOB_PIT_ID,
		JOB_ID,
		JOB_PIT,
		JOB_PIT_DATE
		FROM
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME
		WHERE
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_ID = ".$IniJobIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

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