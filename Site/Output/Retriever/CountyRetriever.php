<?php
function CountyRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COUNTY.COU_ID,
		".$sPrefix."VIEW_COUNTY.COU_DATA_ID,
		".$sPrefix."VIEW_COUNTY.COUN_ID,
		".$sPrefix."VIEW_COUNTY.COU_ACCESS
		FROM
		".$sPrefix."VIEW_COUNTY
		WHERE
		(".$sPrefix."VIEW_COUNTY.COU_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTY.COU_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CountyDataRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID,
		".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
		".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
		".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
		".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_COUNTY_DATA
		WHERE
		(".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CountyGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COU_ID,
		COU_ACCESS,
		COU_AVAIL,
		COU_DATA_ACCESS,
		COU_DATA_AVAIL,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COU_DATA_DATE
		FROM
		".$sPrefix."VIEW_COUNTY_GENERAL
		WHERE
		".$sPrefix."VIEW_COUNTY_GENERAL.COU_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTY_GENERAL.COU_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTY_GENERAL.COU_ACCESS > ".($IniUserAccessLevel - 1).";";

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

function CountyOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COU_ID,
		COU_DATA_ACCESS,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR
		FROM
		".$sPrefix."VIEW_COUNTY_OVERVIEW
		WHERE
		".$sPrefix."VIEW_COUNTY_OVERVIEW.COU_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTY_OVERVIEW.COU_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTY_OVERVIEW.COU_ACCESS > ".($IniUserAccessLevel - 1).";";

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

function CountySelectElemRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COU_ID,
		COU_DATA_TITLE
		FROM
		".$sPrefix."VIEW_COUNTY_GENERAL
		WHERE
		".$sPrefix."VIEW_COUNTY_GENERAL.COU_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTY_GENERAL.COU_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTY_GENERAL.COU_ACCESS > ".($IniUserAccessLevel - 1).";";

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