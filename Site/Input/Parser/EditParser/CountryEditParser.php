<?php
//-------------<FUNCTION>-------------//
function CountryEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_COUNTRY_EDIT
		SET
		".$sPrefix."VIEW_COUNTRY_EDIT.COUN_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTRY_EDIT.COUN_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTRY_EDIT.COUN_ID = ".$IniCountryIndex.");";

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

function CountryDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountryDataIndex, string &$InsTitle, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsTitle))
	{
		if(($IniCountryDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE
			".$sPrefix."VIEW_COUNTRY_DATA_EDIT
			SET
			".$sPrefix."VIEW_COUNTRY_DATA_EDIT.COUN_DATA_TITLE = \"".$InsTitle."\",
			".$sPrefix."VIEW_COUNTRY_DATA_EDIT.COUN_DATA_ACCESS_ID = ".$IniContentAccessLevelIndex."
			WHERE
			(".$sPrefix."VIEW_COUNTRY_DATA_EDIT.COUN_DATA_AVAIL_ID = ".$IniIsAvailIndex.")
			AND
			(".$sPrefix."VIEW_COUNTRY_DATA_EDIT.COUN_DATA_ID = ".$IniCountryDataIndex.");";

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