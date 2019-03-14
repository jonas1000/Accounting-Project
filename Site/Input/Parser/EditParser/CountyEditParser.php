<?php
//-------------<FUNCTION>-------------//
function CountyEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniCountryIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountyIndex > 0) && ($IniCountryIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE 
        ".$sPrefix."VIEW_COUNTY
        SET
        ".$sPrefix."VIEW_COUNTY.COUN_ID = ".$IniCountryIndex.",
        ".$sPrefix."VIEW_COUNTY.COU_ACCESS = ".$IniContentAccessLevelIndex."
        WHERE
		(".$sPrefix."VIEW_COUNTY.COU_ID = ".$IniCountyIndex."
		AND
		".$sPrefix."VIEW_COUNTY.COU_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_COUNTY.COU_AVAIL = ".$IniIsAvailIndex.");";

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

function CountyDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCountyDataIndex, string &$InsTitle, float &$InfTax, float &$InfInterestRate, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InsTitle, $InsDate))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE 
            ".$sPrefix."VIEW_COUNTY_DATA
            SET
            ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE = ".$InsTitle.",
            ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX = ".(($InfTax > -1) ? $InfTax : 0).",
            ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR = ".(($InfInterestRate > -1 ? $InfInterestRate : 0)).",
            ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_DATE = ".$InsDate.",
            ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS = ".$IniContentAccessLevelIndex."
            WHERE
			(".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID = ".$IniCountyDataIndex."
			AND
			".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS > ".($IniUserAccessLevelIndex - 1)."
			AND
			".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL = ".$IniIsAvailIndex.");";

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