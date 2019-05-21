<?php
function CountyVisParser(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountyIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_COUNTY_VISIBILITY
		SET
		".$sPrefix."VIEW_COUNTY_VISIBILITY.COU_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTY_VISIBILITY.COU_ID = ".$IniCountyIndex.");";

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

function CountyDataVisParser(ME_CDBConnManager &$InDBConn, int &$IniCountyDataIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountyDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_COUNTY_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_COUNTY_DATA_VISIBILITY.COU_DATA_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_COUNTY_DATA_VISIBILITY.COU_DATA_ID = ".$IniCountyDataIndex.");";

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