<?php
function CountryGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		COUN_ID,
		COUN_AVAIL,
		COUN_ACCESS,
		COUN_DATA_ID,
		COUN_DATA_ACCESS,
		COUN_DATA_AVAIL,
		COUN_DATA_TITLE
		FROM
		".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_ID = ".$IniCountryIndex.";";

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