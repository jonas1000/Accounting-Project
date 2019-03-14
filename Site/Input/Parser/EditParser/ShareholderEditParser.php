<?php
function ShareholderEditParser(ME_CDBConnManager &$InDBConn, int &$IniShareholderIndex, int &$IniEmployeeIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniEmployeeIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
        $sDBQuery = "";
        $sDBPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
        ".$sDBPrefix."VIEW_SHAREHOLDER
        SET
        ".$sDBPrefix."VIEW_SHAREHOLDER.EMP_ID = ".$IniEmployeeIndex.",
        ".$sDBPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS = ".$IniContentAccessLevelIndex."
        WHERE
		(".$sDBPrefix."VIEW_SHAREHOLDER.SHARE_ID = ".$IniShareholderIndex."
		AND
		".$sDBPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS > ".($IniUserAccessLevelIndex - 1)."
        AND
        ".$sDBPrefix."VIEW_SHAREHOLDER.SHARE_AVAIL = ".$IniIsAvailIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sDBPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}
?>