<?php
function CountryRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COUNTRY.COUN_ID,
		".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID,
		".$sPrefix."VIEW_COUNTRY.COUN_ACCESS
		FROM
		".$sPrefix."VIEW_COUNTRY
		WHERE
		(".$sPrefix."VIEW_COUNTRY.COUN_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTRY.COUN_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CountryDataRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_DATE,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_COUNTRY_DATA
		WHERE
		(".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CountryGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COUN_ID,
		COUN_AVAIL,
		COUN_ACCESS,
		COUN_DATA_ID,
		COUN_DATA_ACCESS,
		COUN_DATA_AVAIL,
		COUN_DATA_TITLE
		FROM
		".$sPrefix."VIEW_COUNTRY_GENERAL
		WHERE
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniUserAccessLevel - 1).";";

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

function CountryOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COUN_ID,
		COUN_ACCESS,
		COUN_DATA_ACCESS,
		COUN_DATA_TITLE
		FROM
		".$sPrefix."VIEW_COUNTRY_OVERVIEW
		WHERE
		".$sPrefix."VIEW_COUNTRY_OVERVIEW.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_OVERVIEW.COUN_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_OVERVIEW.COUN_ACCESS > ".($IniUserAccessLevel - 1).";";

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

function CountrySelectElemRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COUN_ID,
		COUN_DATA_TITLE
		FROM
		".$sPrefix."VIEW_COUNTRY_GENERAL
		WHERE
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniUserAccessLevel - 1).";";

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