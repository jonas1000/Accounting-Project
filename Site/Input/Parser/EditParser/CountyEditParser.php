<?php
//-------------<FUNCTION>-------------//
function CountyEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniCountryIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountyIndex > 0) && ($IniCountryIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_COUNTY_EDIT
		SET
		".$sPrefix."VIEW_COUNTY_EDIT.COUN_ID = ".$IniCountryIndex.",
		".$sPrefix."VIEW_COUNTY_EDIT.COU_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTY_EDIT.COU_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COUNTY_EDIT.COU_ID = ".$IniCountyIndex.");";

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

function CountyDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountyDataIndex, string &$InsTitle, float &$InfTax, float &$InfInterestRate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsTitle))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE
			".$sPrefix."VIEW_COUNTY_DATA_EDIT
			SET
			".$sPrefix."VIEW_COUNTY_DATA_EDIT.COU_DATA_TITLE = \"".$InsTitle."\",
			".$sPrefix."VIEW_COUNTY_DATA_EDIT.COU_DATA_TAX = ".$InfTax.",
			".$sPrefix."VIEW_COUNTY_DATA_EDIT.COU_DATA_IR = ".$InfInterestRate.",
			".$sPrefix."VIEW_COUNTY_DATA_EDIT.COU_DATA_ACCESS_ID = ".$IniContentAccessLevelIndex."
			WHERE
			(".$sPrefix."VIEW_COUNTY_DATA_EDIT.COU_DATA_AVAIL_ID = ".$IniIsAvailIndex.")
			AND
			(".$sPrefix."VIEW_COUNTY_DATA_EDIT.COU_DATA_ID = ".$IniCountyDataIndex.");";

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
	else
		throw new Exception("Input parameters are empty");
}
?>