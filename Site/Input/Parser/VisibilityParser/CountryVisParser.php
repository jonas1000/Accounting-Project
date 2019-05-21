<?php
function CountryVisParser(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_COUNTRY_VISIBILITY
		SET
		".$sPrefix."VIEW_COUNTRY_VISIBILITY.COUN_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTRY_VISIBILITY.COUN_ID = ".$IniCountryIndex.");";

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

function CountryDataVisParser(ME_CDBConnManager &$InDBConn, int &$IniCountryDataIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountryDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY.COUN_DATA_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY.COUN_DATA_ID = ".$IniCountryDataIndex.");";

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