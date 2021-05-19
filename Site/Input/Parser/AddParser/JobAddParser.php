<?php
function JobAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobDataIndex, int $IniJobOutIndex, int $IniJobIncIndex, int $IniCompanyIndex, int $IniContentAccess, int $IniAvail) : bool
{
	if(($IniJobDataIndex > 0) &&
	($IniJobOutIndex > 0) &&
	($IniJobIncIndex > 0) &&
	($IniCompanyIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_JOB_ADD
		(JOB_DATA_ID,
		JOB_INC_ID,
		JOB_OUT_ID,
		COMP_ID,
		JOB_ACCESS_ID,
		JOB_AVAIL_ID) 
		VALUES(?, ?, ?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiiiii", $IniJobDataIndex, $IniJobIncIndex, $IniJobOutIndex, $IniCompanyIndex, $IniContentAccess, $IniAvail))
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

function JobDataAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, string &$InsName, string &$InsDate, int $IniContentAccess, int $IniAvail) : bool
{
	if(!ME_MultyCheckEmptyType($InsName, $InsDate) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_JOB_DATA_ADD
		(JOB_DATA_TITLE,
		JOB_DATA_DATE,
		JOB_DATA_ACCESS_ID,
		JOB_DATA_AVAIL_ID) 
		VALUES(?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ssii", $InsName, $InsDate, $IniContentAccess, $IniAvail))
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

function JobIncomeAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, float $InfPrice, float $InfPIA, int $IniContentAccess, int $IniAvail) : bool
{
	if(CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fPrice = round(((empty($InfPrice)) ? 0 : abs($InfPrice)), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);
		$fPIA = round(((empty($InfPIA))? 0 : abs($InfPIA)), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);

		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_JOB_INCOME_ADD
		(JOB_INC_PRICE,
		JOB_INC_PIA,
		JOB_INC_ACCESS_ID,
		JOB_INC_AVAIL_ID)
		VALUES(?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ddii", $fPrice, $fPIA, $IniContentAccess, $IniAvail))
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

function JobOutcomeAddParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, float $InfExpenses, float $InfDamage, int $IniContentAccess, int $IniAvail) : bool
{
	if(CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fExpenses = round((empty($InfExpenses)) ? 0 : -(abs($InfExpenses)), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);
		$fDamage = round((empty($InfDamage)) ? 0 : -(abs($InfDamage)), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);

		$sQuery = "INSERT INTO ".$InrConn->GetPrefix()."VIEW_JOB_OUTCOME_ADD
		(JOB_OUT_EXPENSES,
		JOB_OUT_DAMAGE,
		JOB_OUT_ACCESS_ID,
		JOB_OUT_AVAIL_ID) 
		VALUES(?, ?, ?, ?);";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ddii", $fExpenses, $fDamage, $IniContentAccess, $IniAvail))			
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
?>