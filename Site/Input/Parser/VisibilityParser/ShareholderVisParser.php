<?php
function ShareholderVisParser(CDBConnManager &$InDBConn, int &$IniShareIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniShareIndex, $IniIsAvailIndex))
	{
		if(($IniShareIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER
			SET
			".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER.SHARE_AVAIL = ". $IniIsAvailIndex."
			WHERE
			".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER.SHARE_ID = ".$IniShareIndex.";";

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
	else
		throw new Exception("Input parameters are empty");
}
?>
