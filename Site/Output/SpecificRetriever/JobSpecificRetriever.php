<?php
function JobSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniJobIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		AND
		(".$sPrefix."VIEW_JOB.JOB_ID = ".$IniJobIndex.");";

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

function JobDataSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobDataIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniJobDataIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		AND
		(".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ID = ".$IniJobDataIndex.");";

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

function JobIncomeSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobIncomeIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniJobIncomeIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		AND
		(".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ID = ".$IniJobIncomeIndex.");";

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

function JobOutcomeSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobOutcomeIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniJobOutcomeIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		AND
		(".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID = ".$IniJobOutcomeIndex.");";

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

function JobGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniJobIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
        $sDBQuery = "";
        $sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		JOB_ID,
		JOB_ACCESS,
		JOB_DATA_ID,
		JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_INC_ID,
		JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_OUT_ID,
		JOB_OUT_EXPENSES,
		JOB_OUT_DAMAGE,
		COMP_ID,
		COMP_DATA_TITLE,
		COMP_DATA_DATE
		FROM
		".$sPrefix."VIEW_JOB_GENERAL
		WHERE
		(".$sPrefix."VIEW_JOB_GENERAL.JOB_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$sPrefix."VIEW_JOB_GENERAL.JOB_INC_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$sPrefix."VIEW_JOB_GENERAL.JOB_OUT_AVAIL = " .$IniIsAvailIndex . "
		AND
		".$sPrefix."VIEW_JOB_GENERAL.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_JOB_GENERAL.COMP_DATA_AVAIL = " .$IniIsAvailIndex . "
		AND
        ".$sPrefix."VIEW_JOB_GENERAL.JOB_ACCESS > ".($IniUserAccessLevel - 1)."
        AND
        ".$sPrefix."VIEW_JOB_GENERAL.JOB_ID = ".$IniJobIndex.");";

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

function JobPITSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobPITIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniJobPITIndex > 0) && ($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		JOB_PIT_ID,
		JOB_PIT_ACCESS,
		JOB_ID,
		JOB_PIT_PAYMENT,
		JOB_PIT_DATE
		FROM
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS > ".($IniUserAccessLevel - 1)."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ID = ".$IniJobPITIndex.");";

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

function JobPITByJobIDSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniUserAccessLevel) : void
{
	if(($IniJobIndex > 0) && ($IniUserAccessLevel > 0))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		JOB_ID,
		JOB_PIT_SUM
		FROM
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME_SUM_AVAIL
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME_SUM_AVAIL.JOB_PIT_ACCESS > ".($IniUserAccessLevel - 1)."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME_SUM_AVAIL.JOB_ID = ".$IniJobIndex.");";

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