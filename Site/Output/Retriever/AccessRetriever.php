<?php
function AccessFormRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM
		".$InDBConn->GetPrefix()."VIEW_ACCESS
		WHERE
		".$InDBConn->GetPrefix()."VIEW_ACCESS.ACCESS_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_ACCESS.ACCESS_LEVEL > ".($IniUserAccessLevelIndex - 1)."
		ORDER BY
		".$InDBConn->GetPrefix()."VIEW_ACCESS.ACCESS_LEVEL ASC;";

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

function AccessSelectFormRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM
		".$InDBConn->GetPrefix()."VIEW_ACCESS
		WHERE
		".$InDBConn->GetPrefix()."VIEW_ACCESS.ACCESS_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_ACCESS.ACCESS_LEVEL > ".($IniUserAccessLevelIndex - 1)."
		ORDER BY
		".$InDBConn->GetPrefix()."VIEW_ACCESS.ACCESS_LEVEL ASC;";

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