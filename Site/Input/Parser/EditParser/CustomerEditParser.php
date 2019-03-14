<?php
//-------------<FUNCTION>-------------//
function CustomerEditParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE 
        ".$sPrefix."VIEW_CUSTOMER
        SET
        ".$sPrefix."VIEW_CUSTOMER.CUST_ACCESS = ".$IniContentAccessLevelIndex.",
        WHERE
		(".$sPrefix."VIEW_CUSTOMER.CUST_ID = ".$IniCustomerIndex."
		AND
		".$sPrefix."VIEW_CUSTOMER.CUST_ACCESS > ".($IniUserAccessLevelIndex - 1)."
		AND
		".$sPrefix."VIEW_CUSTOMER.CUST_AVAIL = ".$IniIsAvailIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning detected: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function CustomerDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerDataIndex, string &$InsName, string &$InsSurname, string &$InsPhoneNumber, string &$InsStableNumber, string &$InsEmail, string &$InsVAT, string &$InsAddr, string &$InsNote, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPhoneNumber))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE 
            ".$sPrefix."VIEW_CUSTOMER_DATA
            SET
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NAME = ".$InsName.",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SURNAME = ".$InsSurname.",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_PN = ".$InsPhoneNumber.",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SN = ".(empty($InsStableNumber) ? "NULL" : $InsStableNumber).",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_EMAIL = ".(empty($InsEmail) ? "NULL" : $InsEmail).",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ADDR = "(empty($InsAddr) ? "NULL" : $InsAddr)",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_VAT = "(empty($InsVAT) ? "NULL" : $InsVAT)",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NOTE = "(empty($InsNote) ? "NULL" : $InsNote)",
            ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS = ".$IniContentAccessLevelIndex."
            WHERE
			(".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ID = ".$IniCustomerDataIndex."
			AND
			".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS > ".$IniUserAccessLevelIndex."
			AND
			".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_AVAIL = ".$IniIsAvailIndex.");";

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
	else
		throw new Exception("Input parameters are empty");
}
?>