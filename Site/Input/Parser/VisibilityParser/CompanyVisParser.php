<?php
function CompanyVisParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCompanyIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_COMPANY_VISIBILITY
		SET
		".$sPrefix."VIEW_COMPANY_VISIBILITY.COMP_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_COMPANY_VISIBILITY.COMP_ID = ".$IniCompanyIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function CompanyDataVisParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyDataIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCompanyDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_COMPANY_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_COMPANY_DATA_VISIBILITY.COMP_DATA_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_COMPANY_DATA_VISIBILITY.COMP_DATA_ID = ".$IniCompanyDataIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}
?>