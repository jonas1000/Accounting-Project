<?php
//-------------<FUNCTION>-------------//
function CustomerAddParser(ME_CDBConnManager &$InDBConn, int $IniContentAccessLevelIndex, int $IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_CUSTOMER
		(
		CUST_DATA_ID,
		CUST_ACCESS,
		CUST_AVAIL
		)
		VALUES
		(
		".$InDBConn->GetLastQueryID().",
		".$IniContentAccessLevelIndex.",
		".$IniIsAvailIndex."
		);";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning detected: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function CustomerDataAddParser(ME_CDBConnManager &$InDBConn, string &$InsName, string &$InsSurname, string &$InsPN, string &$InsSN, string &$InsEmail, string &$InsVAT, string &$InsAddr, string &$InsNote, int $IniContentAccessLevelIndex, int $IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPN))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_CUSTOMER_DATA(
			CUST_DATA_NAME,
			CUST_DATA_SURNAME,
			CUST_DATA_PN,
			CUST_DATA_SN,
			CUST_DATA_EMAIL,
			CUST_DATA_VAT,
			CUST_DATA_ADDR,
			CUST_DATA_NOTE,
			CUST_DATA_ACCESS,
			CUST_DATA_AVAIL)
			VALUES(
			\"".$InsName."\",
			\"".$InsSurname."\",
			\"".$InsPN."\",
			".(empty($InsSN) ? "NULL" : "\"".$InsSN."\"").",
			".(empty($InsEmail) ? "NULL" : "\"".$InsEmail."\"").",
			".(empty($InVat) ? "NULL" : "\"".$InsVAT."\"").",
			\"".(empty($InsAddr) ? "None" : $InsAddr)."\",
			\"".(empty($InsNote) ? "None" : $InsNote)."\",
			".$IniContentAccessLevelIndex.",
			".$IniIsAvailIndex.");";

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
	else
		throw new Exception("Input parameters are empty");
}
?>