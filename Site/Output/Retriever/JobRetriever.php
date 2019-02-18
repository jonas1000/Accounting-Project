<?php
function JobGeneralRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
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
			".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_ACCESS > ".($IniAccessIndex - 1).";";

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
	else
		throw new Exception("Input parameters are empty");
}

function JobOverviewRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < 3))
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
			".$InDBConn->GetPrefix()."VIEW_JOB_GENERAL.JOB_ACCESS > ".($IniAccessIndex - 1).";";

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

function JobPitRetriever(CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniJobIndex, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniJobIndex > 0 && $IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
			".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS > ".($IniAccessIndex - 1).";";

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