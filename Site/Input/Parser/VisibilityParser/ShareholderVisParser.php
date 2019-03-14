<?php
function ShareholderVisParser(ME_CDBConnManager &$InDBConn, int &$IniShareIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniShareIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER
		SET
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER.SHARE_AVAIL = ". $IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER.SHARE_ID = ".$IniShareIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER.SHARE_ACCESS > ".($IniUserAccessLevelIndex - 1).");";

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
