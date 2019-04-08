<?php
function CountySpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountyIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
        (".$sPrefix."VIEW_COUNTY.COU_ACCESS > ".($IniUserAccessLevel - 1).")
        AND
        (".$sPrefix."VIEW_COUNTY.COU_ID = ".$IniCountyIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix, $iUserAccessLevelIndex);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function CountyDataSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountyDataIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountyDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
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
        (".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS > ".($IniUserAccessLevel - 1).")
        AND
        (".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID = ".$IniCountyDataIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix, $iUserAccessLevelIndex);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function CountyEditFormSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCountyIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();
		$iUserAccessLevelIndex = ($IniUserAccessLevel - 1);

		$sDBQuery = "SELECT
        ".$sPrefix."VIEW_COUNTY.COU_ID,
        ".$sPrefix."VIEW_COUNTY.COUN_ID,
        ".$sPrefix."VIEW_COUNTY.COU_ACCESS,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS
        FROM
        ".$sPrefix."VIEW_COUNTY,
        ".$sPrefix."VIEW_COUNTY_DATA
        WHERE
        (".$sPrefix."VIEW_COUNTY.COU_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL = ".$IniIsAvailIndex.")
        AND
        (".$sPrefix."VIEW_COUNTY.COU_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS > ".$iUserAccessLevelIndex.")
        AND
        (".$sPrefix."VIEW_COUNTY.COU_ID = ".$IniCountyIndex.")
        AND
        (".$sPrefix."VIEW_COUNTY.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID);";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix, $iUserAccessLevelIndex);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}
?>