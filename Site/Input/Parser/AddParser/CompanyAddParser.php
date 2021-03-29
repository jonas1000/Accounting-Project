<?php
//-------------<FUNCTION>-------------//
function CompanyAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompanyDataIndex, int $IniCountyIndex, int $IniContentAccess, int $IniAvail) : bool
{
	if(($IniCompanyDataIndex > 0) &&
	($IniCountyIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		//The query string to be binded by the statement
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_COMPANY_ADD(COMP_DATA_ID, COU_ID, COMP_ACCESS_ID, COMP_AVAIL_ID) 
		VALUES(?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiii", $IniCompanyDataIndex, $IniCountyIndex, $IniContentAccess, $IniAvail))
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __METHOD__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __METHOD__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __METHOD__, __LINE__);

	return FALSE;
}

function CompanyDataAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsName, string &$InsDate, int $IniContentAccess, int $IniAvail) : bool
{
	if(!ME_MultyCheckEmptyType($InsName, $InsDate) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		//The query string to be binded by the statement
		$sQuery = "INSERT INTO 
		".$InrConn->GetPrefix()."VIEW_COMPANY_DATA_ADD(COMP_DATA_TITLE, COMP_DATA_DATE, COMP_DATA_ACCESS_ID, COMP_DATA_AVAIL_ID) 
		VALUES(?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ssii", $InsName, $InsDate, $IniContentAccess, $IniAvail))				
				return ME_SQLStatementExecAndClose($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __METHOD__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __METHOD__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __METHOD__, __LINE__);

	return FALSE;
}
?>