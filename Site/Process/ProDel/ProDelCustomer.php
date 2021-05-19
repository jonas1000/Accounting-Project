<?php
//-------------<FUNCTION>-------------//
function ProDelCustomer(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['CustIndex']) && !empty($_POST['CustIndex']) && is_numeric($_POST['CustIndex']))
	{
		//variables consindered to be holding ID
		$iCustomerIndex = (int) $_POST['CustIndex'];

		if(($iCustomerIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			$rResult = CustomerSpecificRetriever($InrConn, $InrLogHandle, $iCustomerIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

			if(!empty($rResult) && ($rResult->num_rows == 1))
			{
				$aDataRow = $rResult->fetch_assoc();

				if(CustomerVisParser($InrConn, $InrLogHandle, (int) $aDataRow['CUST_ID'], $GLOBALS['AVAILABLE']['HIDE']) &&
				CustomerDataVisParser($InrConn, $InrLogHandle, (int) $aDataRow['CUST_DATA_ID'], $GLOBALS['AVAILABLE']['HIDE']))
					$InrConn->Commit();
				else
				{
					$InrConn->RollBack();

					$InrLogHandle->AddLogMessage("Failed to update tables", __FILE__, __FUNCTION__, __LINE__);
				}

				$rResult->free();
			}
			else
				$InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>