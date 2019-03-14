<?php
function CompanyVisParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCompanyIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_COMPANY
		SET
		".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ID = ".$IniCompanyIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ACCESS > ".$IniUserAccessLevelIndex.");";

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
