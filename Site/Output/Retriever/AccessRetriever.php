<?php
function AccessSelectElemRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM
		".$sPrefix."VIEW_ACCESS
		WHERE
		".$sPrefix."VIEW_ACCESS.ACCESS_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$sPrefix."VIEW_ACCESS.ACCESS_LEVEL > ".($IniUserAccessLevel - 1)."
		ORDER BY
		".$sPrefix."VIEW_ACCESS.ACCESS_LEVEL ASC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function AccessSelectFormRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		ACCESS_ID,
		ACCESS_TITLE,
		ACCESS_LEVEL
		FROM
		".$sPrefix."VIEW_ACCESS
		WHERE
		".$sPrefix."VIEW_ACCESS.ACCESS_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$sPrefix."VIEW_ACCESS.ACCESS_LEVEL > ".($IniUserAccessLevel - 1)."
		ORDER BY
		".$sPrefix."VIEW_ACCESS.ACCESS_LEVEL ASC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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