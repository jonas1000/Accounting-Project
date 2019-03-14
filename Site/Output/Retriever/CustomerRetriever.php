<?php
function CustomerGeneralRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = NULL;

		$sDBQuery = "SELECT
		CUST_ID,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_EMAIL,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE
		FROM
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER_GENERAL
		WHERE
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER_GENERAL.CUST_AVAIL = " . $IniIsAvailIndex . "
		AND
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER_GENERAL.CUST_ACCESS > ".($IniUserAccessLevelIndex - 1).";";

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