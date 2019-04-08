<?php
function CustomerVisParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCustomerIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_CUSTOMER_VISIBILITY
		SET
		".$sPrefix."VIEW_CUSTOMER_VISIBILITY.CUST_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_VISIBILITY.CUST_ID = ".$IniCustomerIndex.");";

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

function CustomerDataVisParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerDataIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCustomerDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY.CUST_DATA_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY.CUST_DATA_ID = ".$IniCustomerDataIndex.");";

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