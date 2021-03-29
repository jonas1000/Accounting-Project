<?php
//-------------<FUNCTION>-------------//
function CountyEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountyIndex, int $IniCountryIndex, int $IniContentAccess, int $IniAvail)
{
	if(($IniCountyIndex > 0) &&
	($IniCountryIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_COUNTY_EDIT
		SET 
		COU_ACCESS_ID = ?,
		COU_AVAIL_ID = ?
		WHERE 
		COU_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iii", $IniContentAccess, $IniAvail, $IniCountyIndex))
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

function CountyDataEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountyDataIndex, string &$InsTitle, float $InfTax, float $InfInterestRate, int $IniContentAccess, int $IniAvail)
{
	if(!empty($InsTitle) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_COUNTY_DATA_EDIT
		SET 
		COU_DATA_TITLE = ?,
		COU_DATA_TAX = ?,
		COU_DATA_IR = ?,
		COU_DATA_ACCESS_ID = ?,
		COU_DATA_AVAIL_ID = ?
		WHERE 
		COU_DATA_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("sddiii", $InsTitle, $InfTax, $InfInterestRate, $IniContentAccess, $IniAvail, $IniCountyDataIndex))
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