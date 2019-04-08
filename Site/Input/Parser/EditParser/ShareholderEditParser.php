<?php
function ShareholderEditParser(ME_CDBConnManager &$InDBConn, int &$IniShareholderIndex, int &$IniEmployeeIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniEmployeeIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
        $sDBQuery = "";
        $sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_SHAREHOLDER_EDIT
		SET
		".$sPrefix."VIEW_SHAREHOLDER_EDIT.EMP_ID = ".$IniEmployeeIndex.",
		".$sPrefix."VIEW_SHAREHOLDER_EDIT.SHARE_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_SHAREHOLDER_EDIT.SHARE_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_SHAREHOLDER_EDIT.SHARE_ID = ".$IniShareholderIndex.");";

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