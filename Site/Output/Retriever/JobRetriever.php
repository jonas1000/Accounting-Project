<?php
function JobRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "SELECT
		".$sPrefix."VIEW_JOB.JOB_ID,
		".$sPrefix."VIEW_JOB.JOB_DATA_ID,
		".$sPrefix."VIEW_JOB.JOB_INC_ID,
		".$sPrefix."VIEW_JOB.JOB_OUT_ID,
		".$sPrefix."VIEW_JOB.COMP_ID,
		".$sPrefix."VIEW_JOB.JOB_ACCESS
		FROM
		".$sPrefix."VIEW_JOB
		WHERE
		(".$sPrefix."VIEW_JOB.JOB_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB.JOB_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY JOB_ID DESC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function JobDataRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "SELECT
		".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ID,
		".$sPrefix."VIEW_JOB_DATA.JOB_DATA_TITLE,
		".$sPrefix."VIEW_JOB_DATA.JOB_DATA_DATE,
		".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_JOB_DATA
		WHERE
		(".$sPrefix."VIEW_JOB_DATA.JOB_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY JOB_DATA_ID DESC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function JobIncomeRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "SELECT
		".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ID,
		".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PRICE,
		".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PIA,
		".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS
		FROM
		".$sPrefix."VIEW_JOB_INCOME
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME.JOB_INC_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY JOB_INC_ID DESC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function JobOutcomeRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		
		$sDBQuery = "SELECT
		".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID,
		".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_EXPENSES,
		".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_DAMAGE,
		".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS
		FROM
		".$sPrefix."VIEW_JOB_OUTCOME
		WHERE
		(".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY JOB_OUT_ID DESC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function JobOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		JOB_ID,
		JOB_DATA_ACCESS,
		JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_INC_ACCESS,
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_OUT_ACCESS,
		JOB_OUT_EXPENSES,
		JOB_OUT_DAMAGE,
		COMP_DATA_ACCESS,
		COMP_DATA_TITLE
		FROM
		".$sPrefix."VIEW_JOB_OVERVIEW
		WHERE
		".$sPrefix."VIEW_JOB_OVERVIEW.JOB_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_OVERVIEW.JOB_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_OVERVIEW.JOB_INC_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_OVERVIEW.JOB_OUT_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_OVERVIEW.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_OVERVIEW.JOB_ACCESS > ".($IniUserAccessLevel - 1)."
		ORDER BY JOB_DATA_DATE DESC;";

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

function JobPITRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if($IniJobIndex > 0 && $IniUserAccessLevel > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		JOB_ID,
		JOB_PIT_ID,
		JOB_PIT_PAYMENT,
		JOB_PIT_ACCESS,
		JOB_PIT_DATE
		FROM
		".$sPrefix."VIEW_JOB_INCOME_TIME
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS > ".($IniUserAccessLevel - 1)."
		AND
		".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_ID = ".$IniJobIndex.")
		ORDER BY JOB_PIT_DATE DESC;";

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