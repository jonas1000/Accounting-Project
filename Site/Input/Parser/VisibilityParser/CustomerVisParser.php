<?php
function CustomerVisParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCustomerIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER
		SET
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER.CUST_AVAIL = ".$IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_CUSTOMER.CUST_ID = ".$IniCustomerIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER.CUST_ACCESS > ".($IniUserAccessLevelIndex - 1).");";

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
