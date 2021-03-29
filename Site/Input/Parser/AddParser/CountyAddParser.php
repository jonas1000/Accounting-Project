<?php
//-------------<FUNCTION>-------------//
function CountyAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountyDataIndex, int $IniCountryIndex, int $IniContentAccess, int $IniAvail) : bool
{
	if(($IniCountyDataIndex > 0) &&
	($IniCountryIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		//The query string to be binded by the statement
		$sQuery = "INSERT INTO VIEW_COUNTY_ADD(COU_DATA_ID, COUN_ID, COU_ACCESS_ID, COU_AVAIL_ID) 
		VALUES(?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiii", $IniCountyDataIndex, $IniCountryIndex, $IniContentAccess, $IniAvail))
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return TRUE;
}

function CountyDataAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsTitle, float $InfTax, float $InfInterestRate, int $IniContentAccess, int $IniAvail) : bool
{
	if(!empty($InsTitle) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fTax = abs($InfTax);
		$fInterestRate = abs($InfInterestRate);

		//The query string to be binded by the statement
		$sQuery = "INSERT INTO VIEW_COUNTY_DATA_ADD(COU_DATA_TITLE, COU_DATA_TAX, COU_DATA_IR, COU_DATA_ACCESS_ID, COU_DATA_AVAIL_ID) 
		VALUES(?, ?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("sddii", $InsTitle, $fTax, $fInterestRate, $IniContentAccess, $IniAvail))
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