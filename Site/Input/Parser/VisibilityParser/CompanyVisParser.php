<?php
function CompanyVisParser(CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniCompanyIndex, $IniIsAvailIndex))
	{
		if(($IniCompanyIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_COMPANY
			SET
			".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_AVAIL = " . $IniIsAvailIndex . "
			WHERE
			".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ID = " . $IniCompanyIndex . ";";

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
