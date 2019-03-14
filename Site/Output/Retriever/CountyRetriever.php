<?php
function CountyGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		COU_ID,
		COU_ACCESS,
		COU_AVAIL,
		COU_DATA_ACCESS,
		COU_DATA_AVAIL,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COU_DATA_DATE
		FROM
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL.COU_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL.COU_DATA_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL.COU_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

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

function CountyFormRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		COU_ID,
		COU_DATA_TITLE
		FROM
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL.COU_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL.COU_DATA_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTY_GENERAL.COU_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

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