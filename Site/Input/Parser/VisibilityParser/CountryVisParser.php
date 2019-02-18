<?php
function CountryVisParser(CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniCountryIndex, $IniIsAvailIndex))
	{
		if(($IniCountryIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_COUNTRY
			SET
			".$InDBConn->GetPrefix()."VIEW_COUNTRY.COUN_AVAIL = " . $IniIsAvailIndex . "
			WHERE
			".$InDBConn->GetPrefix()."VIEW_COUNTRY.COUN_ID = " . $IniCountryIndex . ";";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception("warning: " . $InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($sDBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>
