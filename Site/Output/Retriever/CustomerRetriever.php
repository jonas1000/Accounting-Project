<?php
function CustomerRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->Getprefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_CUSTOMER.CUST_ID,
		".$sPrefix."VIEW_CUSTOMER.CUST_DATA_ID,
		".$sPrefix."VIEW_CUSTOMER.CUST_ACCESS
		FROM
		".$sPrefix."VIEW_CUSTOMER
		WHERE
		(".$sPrefix."VIEW_CUSTOMER.CUST_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_CUSTOMER.CUST_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CustomerDataRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->Getprefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ID,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NAME,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SURNAME,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_PN,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SN,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_EMAIL,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_VAT,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ADDR,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NOTE,
		".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS
		FROM
		".$sPrefix."VIEW_CUSTOMER_DATA
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CustomerGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->Getprefix();

		$sDBQuery = "SELECT
		CUST_ID,
		CUST_DATA_ACCESS,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_EMAIL,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE
		FROM
		".$sPrefix."VIEW_CUSTOMER_GENERAL
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_GENERAL.CUST_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_CUSTOMER_GENERAL.CUST_ACCESS > ".($IniUserAccessLevel - 1).");";

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

function CustomerOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->Getprefix();

		$sDBQuery = "SELECT
		CUST_ID,
		CUST_DATA_ACCESS,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_EMAIL,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE
		FROM
		".$sPrefix."VIEW_CUSTOMER_OVERVIEW
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_OVERVIEW.CUST_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_CUSTOMER_OVERVIEW.CUST_ACCESS > ".($IniUserAccessLevel - 1).");";

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