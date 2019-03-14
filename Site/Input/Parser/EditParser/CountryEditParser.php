<?php
//-------------<FUNCTION>-------------//
function CountryEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_COUNTRY
		SET
		".$sPrefix."VIEW_COUNTRY.COUN_ACCESS = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTRY.COUN_ID = ".$IniCountryIndex."
		AND
		".$sPrefix."VIEW_COUNTRY.COUN_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_COUNTRY.COUN_AVAIL = ".$IniIsAvailIndex.");";

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

function CountryDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountryDataIndex, string &$InsTitle, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsTitle))
	{
		if(($IniCountryDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE
			".$sPrefix."VIEW_COUNTRY_DATA
			SET
			COUN_DATA_TITLE = \"".$InsTitle."\",
			COUN_DATA_ACCESS = ".$IniContentAccessLevelIndex.",
			COUN_DATA_AVAIL = ".$IniIsAvailIndex."
			WHERE
			(".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID = ".$IniCountryDataIndex."
			AND
			".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS > ".($IniUserAccessLevelIndex - 1)."
			AND
			".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL = ".$IniIsAvailIndex.");";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception("warning detected: " . $InDBConn->GetWarning());
			}
			else
				throw new Exception("Error: " . $InDBConn->GetError());

			unset($sDBQuery, $sPrefix);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>