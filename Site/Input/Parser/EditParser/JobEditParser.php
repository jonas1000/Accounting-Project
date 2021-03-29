<?php
function JobEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobIndex, int $IniCompanyIndex, int $IniContentAccess, int $IniAvail)
{
	if(($IniJobIndex) &&
	($IniCompanyIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_JOB_EDIT
		SET 
		COMP_ID = ?,
		JOB_ACCESS_ID = ?,
		JOB_AVAIL_ID = ?
		WHERE 
		JOB_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("iiii", $IniCompanyIndex, $IniContentAccess, $IniAvail, $IniJobIndex))
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

function JobDataEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobDataIndex, string &$InsName, string &$InsDate, int $IniContentAccess, int $IniAvail)
{
	if(!ME_MultyCheckEmptyType($InsName, $InsDate) &&
	($IniJobDataIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_JOB_DATA_EDIT
		SET 
		JOB_DATA_TITLE = ?,
		JOB_DATA_DATE = ?,
		JOB_DATA_ACCESS_ID = ?,
		JOB_DATA_AVAIL_ID = ?
		WHERE 
		JOB_DATA_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ssiii", $InsName, $InsDate, $IniContentAccess, $IniAvail, $IniJobDataIndex))
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

function JobIncomeEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobIncomeIndex, float $InfPrice, float $InfPIA, int $IniContentAccess, int $IniAvail)
{
	if(CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fPrice = round($InfPrice, $GLOBALS['CURRENCY_DECIMAL_PRECISION']);
		$fPIA = round($InfPIA, $GLOBALS['CURRENCY_DECIMAL_PRECISION']);

		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_JOB_INCOME_EDIT
		SET
		JOB_INC_PRICE = ?,
		JOB_INC_PIA = ?,
		JOB_INC_ACCESS_ID = ?,
		JOB_INC_AVAIL_ID = ?
		WHERE 
		JOB_INC_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ddiii", $fPrice, $fPIA, $IniContentAccess, $IniAvail, $IniJobIncomeIndex))
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

function JobOutcomeEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniJobOutcomeIndex, float $InfExpenses, float $InfDamage, int $IniContentAccess, int $IniAvail)
{
	if(($IniJobOutcomeIndex > 0) &&
	CheckAccessRange($IniContentAccess) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$fExpenses = round((empty($InfExpenses)) ? 0 : -(abs($InfExpenses)), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);
		$fDamage = round((empty($InfDamage)) ? 0 : -(abs($InfDamage)), $GLOBALS['CURRENCY_DECIMAL_PRECISION']);

		$sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_JOB_OUTCOME_EDIT
		SET
		JOB_OUT_EXPENSES = ?,
		JOB_OUT_DAMAGE = ?,
		JOB_OUT_ACCESS_ID = ?,
		JOB_OUT_AVAIL_ID = ?
		WHERE 
		JOB_OUT_ID = ?;";

		//Create the statement query
		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else add an error
			if($rStatement->bind_param("ddiii", $fExpenses, $fDamage, $IniContentAccess, $IniAvail, $IniJobOutcomeIndex))
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