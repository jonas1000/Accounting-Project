<?php
//-------------<FUNCTION>-------------//
function CustomerEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerIndex, int $IniContentAccess, int $IniAvail)
{
	if(CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."CUSTOMER_EDIT
		SET 
		CUST_ACCESS_ID = ?,
		CUST_AVAIL_ID = ?
		WHERE 
		CUST_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iii", $IniContentAccess, $IniAvail, $IniCustomerIndex))
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

function CustomerDataEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerDataIndex, string &$InsName, string &$InsSurname, string &$InsPhoneNumber, string &$InsStableNumber, string &$InsEmail, string &$InsVAT, string &$InsAddr, string &$InsNote, int $IniContentAccess, int $IniAvail)
{
	if(!empty($InsPhoneNumber) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sName = (empty($InsName) ? "None" : $InsName);
		$sSurname = (empty($InsSurname) ? "None" : $InsSurname);
		$sStableNumber = (empty($InsStableNumber) ? "None" : $InsStableNumber);
		$sEmail = (empty($InsEmail) ? "null" : $InsEmail);
		$sVAT = (empty($InsVAT) ? "null" : $InsVAT);
		$sAddr = (empty($InsAddr) ? "None" : $InsAddr);
		$sNote = (empty($InsNote) ? "None" : $InsNote);

		$sQuery = "UPDATE ".$InrConn->GetPrefix()."CUSTOMER_DATA_EDIT
		SET 
		CUST_DATA_NAME = ?,
		CUST_DATA_SURNAME = ?,
		CUST_DATA_PN = ?,
		CUST_DATA_SN = ?,
		CUST_DATA_EMAIL = ?,
		CUST_DATA_VAT = ?,
		CUST_DATA_ADDR = ?,
		CUST_DATA_NOTE = ?,
		CUST_DATA_ACCESS_ID = ?,
		CUST_DATA_AVAIL_ID = ?
		WHERE
		CUST_DATA_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ssssssssiii", $sName, $sSurname, $InsPhoneNumber, $sStableNumber, $sEmail, $sVAT, $sAddr, $sNote, $IniContentAccess, $IniAvail, $IniCustomerDataIndex))
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