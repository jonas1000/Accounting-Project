<?php
function ShareholderAddParser(CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniEmployeeIndex, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniEmployeeIndex > 0) && ($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER
			(
			EMP_ID,
			SHARE_ACCESS,
			SHARE_AVAIL
			)
			VALUES
			(
			".$IniEmployeeIndex.",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

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
