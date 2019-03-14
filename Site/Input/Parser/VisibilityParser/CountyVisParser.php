<?php
function CountyVisParser(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountyIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_COUNTY
		SET
		".$InDBConn->GetPrefix()."VIEW_COUNTY.COU_AVAIL = ".$IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_COUNTY.COU_ID = ".$IniCountyIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_COUNTY.COU_ACCESS > ".($IniUserAccessLevelIndex - 1).");";

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
