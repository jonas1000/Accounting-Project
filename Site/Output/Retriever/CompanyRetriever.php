<?php
function CompanyRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

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
		(".$sPrefix."VIEW_COMPANY.COMP_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CompanyDataRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

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
		(".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CompanyGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

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
		".$sPrefix."VIEW_COMPANY_GENERAL.COMP_ACCESS > ".($IniUserAccessLevel - 1).";";

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

function CompanyOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COMP_ID,
		COMP_DATA_ACCESS,
		COMP_DATA_TITLE,
		COMP_DATA_DATE,
		COU_DATA_ACCESS,
		COU_DATA_TITLE,
		COU_DATA_TAX,
		COU_DATA_IR,
		COUN_DATA_ACCESS,
		COUN_DATA_TITLE
		FROM
		".$sPrefix."VIEW_COMPANY_OVERVIEW
		WHERE
		(".$sPrefix."VIEW_COMPANY_OVERVIEW.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_OVERVIEW.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_OVERVIEW.COU_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_OVERVIEW.COUN_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_OVERVIEW.COUN_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_COMPANY_OVERVIEW.COMP_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CompanySelectElemRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		COMP_ID,
		COMP_DATA_TITLE
		FROM
		".$sPrefix."VIEW_COMPANY,
		".$sPrefix."VIEW_COMPANY_DATA
		WHERE
		".$sPrefix."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID
		AND
		".$sPrefix."VIEW_COMPANY.COMP_ACCESS > ".($IniUserAccessLevel - 1).";";

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