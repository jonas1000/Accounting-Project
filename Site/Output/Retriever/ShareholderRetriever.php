<?php
function ShareholderGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		SHARE_ID,
		EMP_DATA_SALARY,
		EMP_DATA_BDAY,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_EMAIL,
		EMP_POS_TITLE
		FROM
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL.SHARE_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL.EMP_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL.EMP_DATA_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL.EMP_POS_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL.SHARE_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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