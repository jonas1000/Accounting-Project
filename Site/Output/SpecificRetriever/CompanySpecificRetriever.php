<?php
function CompanyGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCompIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniCompIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		COMP_ID,
		COMP_ACCESS,
		COMP_AVAIL,
		COU_ID,
		COMP_DATA_ID,
		COMP_DATA_ACCESS,
		COMP_DATA_AVAIL,
		COMP_DATA_TITLE,
		COMP_DATA_DATE,
		COUN_DATA_TITLE,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COU_DATA_DATE
		FROM
		".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_DATA_AVAIL = " . $IniIsAvailIndex . ")
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_ID = ".$IniCompIndex.";";

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

function CompanyFormSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "SELECT
		COMP_ID,
		COMP_DATA_TITLE
		FROM
		".$InDBConn->GetPrefix()."VIEW_COMPANY,
		".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_DATA_ID = ".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_ID
		AND
		".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ACCESS > ".($IniUserAccessLevelIndex - 1).")
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ID > ".$IniCompanyIndex.");";

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