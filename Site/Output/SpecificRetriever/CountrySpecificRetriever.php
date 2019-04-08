<?php
function CountrySpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		(".$sPrefix."VIEW_COUNTRY.COUN_ACCESS > ".($IniUserAccessLevel - 1).")
		AND
		(".$sPrefix."VIEW_COUNTRY.COUN_ID = ".$IniCountryIndex.");";

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

function CountryDataSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountryDataIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountryDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_COUNTRY_DATA
		WHERE
		(".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS > ".($IniUserAccessLevel - 1).")
		AND
		(".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID = ".$IniCountryDataIndex.");";

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

function CountryGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
		COUN_DATA_TITLE,
		FROM
		".$sPrefix."VIEW_COUNTRY_GENERAL
		WHERE
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniUserAccessLevel - 1)."
		AND
		".$sPrefix."VIEW_COUNTRY_GENERAL.COUN_ID = ".$IniCountryIndex.";";

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

function CountryEditFormSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		$iUserAccessLevelIndex = ($IniUserAccessLevel - 1);

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COUNTRY.COUN_ID,
		".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_COUNTRY,
		".$sPrefix."VIEW_COUNTRY_DATA
		WHERE
		(".$sPrefix."VIEW_COUNTRY.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTRY.COUN_ACCESS > ".$IniUserAccessLevel."
		AND
		".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS > ".$IniUserAccessLevel.")
		AND
		(".$sPrefix."VIEW_COUNTRY.COUN_ID = ".$IniCountryIndex.")
		AND
		(".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

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