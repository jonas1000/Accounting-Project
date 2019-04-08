<?php
function ShareholderVisParser(ME_CDBConnManager &$InDBConn, int &$IniShareIndex, int &$IniIsAvailIndex) : void
{
	if(($IniShareIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_SHAREHOLDER_VISIBILITY
		SET
		".$sPrefix."VIEW_SHAREHOLDER_VISIBILITY.SHARE_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_SHAREHOLDER_VISIBILITY.SHARE_ID = ".$IniShareIndex.");";

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
