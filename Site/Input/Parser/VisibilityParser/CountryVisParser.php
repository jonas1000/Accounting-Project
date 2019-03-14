<?php
function CountryVisParser(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountryIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_COUNTRY
		SET
		".$InDBConn->GetPrefix()."VIEW_COUNTRY.COUN_AVAIL = ".$IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_COUNTRY.COUN_ID = ".$IniCountryIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTRY.COUN_ACCESS > ".($IniUserAccessLevelIndex - 1).");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

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
