<?php
function CustomerSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCustomerIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		CUST_ID,
		CUST_DATA_ID,
		CUST_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER
		WHERE (CUST_AVAIL = ?)
		AND (CUST_ACCESS >= ?)
		AND (CUST_ID = ?);";

        if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCustomerIndex))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
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

function CustomerDataSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerDataIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCustomerDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		CUST_DATA_ID,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_EMAIL,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE,
		CUST_DATA_ACCESS
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER_DATA
		WHERE (CUST_DATA_AVAIL = ?)
		AND (CUST_DATA_ACCESS >= ?)
		AND (CUST_DATA_ID = ?);";

        if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCustomerDataIndex))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
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

function CustomerGeneralSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCustomerIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
		CUST_ID,
        CUST_ACCESS,
        CUST_DATA_ID,
        CUST_DATA_ACCESS,
		CUST_DATA_NAME,
		CUST_DATA_SURNAME,
		CUST_DATA_EMAIL,
		CUST_DATA_PN,
		CUST_DATA_SN,
		CUST_DATA_VAT,
		CUST_DATA_ADDR,
		CUST_DATA_NOTE
		FROM ".$InrConn->GetPrefix()."VIEW_CUSTOMER_GENERAL
		WHERE (CUST_AVAIL = ?
        AND CUST_DATA_AVAIL = ?)
		AND (CUST_ACCESS >= ?
        AND CUST_DATA_ACCESS >= ?)
        AND (CUST_ID = ?);";

        if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiii", $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniCustomerIndex))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
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