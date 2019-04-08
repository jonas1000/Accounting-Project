<?php
function CompanySpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCompanyIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix =$InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COMPANY.COMP_ID,
		".$sPrefix."VIEW_COMPANY.COMP_DATA_ID,
		".$sPrefix."VIEW_COMPANY.COU_ID,
		".$sPrefix."VIEW_COMPANY.COMP_ACCESS
		FROM
		".$sPrefix."VIEW_COMPANY
		WHERE
		(".$sPrefix."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COMPANY.COMP_ACCESS > ".($IniUserAccessLevel - 1).")
		AND
		(".$sPrefix."VIEW_COMPANY.COMP_ID = ".$IniCompanyIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function CompanyDataSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCompanyDataIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCompanyDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix =$InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_COMPANY_DATA
		WHERE
		(".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS > ".($IniUserAccessLevel - 1).")
		AND
		(".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID = ".$IniCompanyDataIndex.");";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function CompanyGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCompIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniCompIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix =$InDBConn->GetPrefix();

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
		".$sPrefix."VIEW_COMPANY_GENERAL
		WHERE
		(".$sPrefix."VIEW_COMPANY_GENERAL.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_GENERAL.COMP_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		".$sPrefix."VIEW_COMPANY_GENERAL.COMP_ACCESS > ".($IniUserAccessLevel - 1)."
		AND
		".$sPrefix."VIEW_COMPANY_GENERAL.COMP_ID = ".$IniCompIndex.";";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function CompanyEditFormSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_COMPANY.COMP_ID,
		".$sPrefix."VIEW_COMPANY.COU_ID,
		".$sPrefix."VIEW_COMPANY.COMP_ACCESS,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_COMPANY,
		".$sPrefix."VIEW_COMPANY_DATA
		WHERE
		(".$sPrefix."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COMPANY.COMP_ID = ".$IniCompanyIndex."
		AND
		".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID);";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

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