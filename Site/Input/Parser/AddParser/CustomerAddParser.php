<?php
//-------------<FUNCTION>-------------//
function CustomerAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerDataIndex, int $IniContentAccess, int $IniAvail) : bool
{
	if(($IniCustomerDataIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		//The query string to be binded by the statement
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_CUSTOMER_ADD(CUST_DATA_ID, CUST_ACCESS_ID, CUST_AVAIL_ID) 
		VALUES(?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iii", $IniCustomerDataIndex, $IniContentAccess, $IniAvail))
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}

function CustomerDataAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsName, string &$InsSurname, string &$InsPN, string &$InsSN, string &$InsEmail, string &$InsVAT, string &$InsAddr, string &$InsNote, int $IniContentAccess, int $IniAvail) : bool
{
	if(!ME_MultyCheckEmptyType($InsName, $InsSurname, $InsPN) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sEmail = (empty($InsEmail) ? "null" : $InsEmail);
		$iVat = (empty($InVat) ? "null" : $InsVAT);

		$sSN = (empty($InsSN) ? "None" : $InsSN);
		$sAddr = (empty($InsAddr) ? "None" : $InsAddr);
		$sNote = (empty($InsNote) ? "None" : $InsNote);

		//The query string to be binded by the statement
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_CUSTOMER_DATA_ADD(CUST_DATA_NAME, CUST_DATA_SURNAME, CUST_DATA_PN, CUST_DATA_SN, CUST_DATA_EMAIL, CUST_DATA_VAT, CUST_DATA_ADDR, CUST_DATA_NOTE, CUST_ACCESS_ID, CUST_AVAIL_ID) 
		VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("sssssissii", $InsName, $InsSurname, $InsPN, $sSN, $sEmail, $iVat, $sAddr, $sNote, $IniContentAccess, $IniAvail))
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>