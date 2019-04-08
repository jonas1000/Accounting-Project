<?php
//-------------<FUNCTION>-------------//
function CustomerEditParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "UPDATE
		".$sPrefix."VIEW_CUSTOMER_EDIT
		SET
		".$sPrefix."VIEW_CUSTOMER_EDIT.CUST_ACCESS_ID = ".$IniContentAccessLevelIndex."
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_EDIT.CUST_AVAIL_ID = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_CUSTOMER_EDIT.CUST_ID = ".$IniCustomerIndex.");";

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

function CustomerDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCustomerDataIndex, string &$InsName, string &$InsSurname, string &$InsPhoneNumber, string &$InsStableNumber, string &$InsEmail, string &$InsVAT, string &$InsAddr, string &$InsNote, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsPhoneNumber))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery = "UPDATE
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT
			SET
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_NAME = \"".(empty($InsName) ? "None" : $InsName)."\",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_SURNAME = \"".(empty($InsSurname) ? "None" : $InsSurname)."\",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_PN = ".$InsPhoneNumber.",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_SN = \"".(empty($InsStableNumber) ? "None" : $InsStableNumber)."\",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_EMAIL = ".(empty($InsEmail) ? "null" : "\"".$InsEmail."\"").",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_VAT = ".(empty($InsVAT) ? "null" : "\"".$InsVAT."\"").",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_ADDR = \"".(empty($InsAddr) ? "None" : $InsAddr)."\",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_NOTE = \"".(empty($InsNote) ? "None" : $InsNote)."\",
			".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_ACCESS_ID = ".$IniContentAccessLevelIndex."
			WHERE
			(".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_AVAIL_ID = ".$IniIsAvailIndex.")
			AND
			(".$sPrefix."VIEW_CUSTOMER_DATA_EDIT.CUST_DATA_ID = ".$IniCustomerDataIndex.");";

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