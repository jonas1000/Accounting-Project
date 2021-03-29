<?php
function CustomerVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerIndex, int $IniAvail)
{
	if(($IniCustomerIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_CUSTOMER_VISIBILITY
		SET
		".$sPrefix."VIEW_CUSTOMER_VISIBILITY.CUST_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_VISIBILITY.CUST_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniCustomerIndex))
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

function CustomerDataVisParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCustomerDataIndex, int $IniAvail)
{
	if(($IniCustomerDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$sQuery="UPDATE
		".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY.CUST_DATA_AVAIL_ID = ?
		WHERE
		(".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY.CUST_DATA_ID = ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ii", $IniAvail, $IniCustomerDataIndex))
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