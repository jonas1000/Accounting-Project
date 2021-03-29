<?php
function ShareholderSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniShareholderIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) && ($IniShareholderIndex > 0) && ($IniAvail > 0 && $IniAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rStatement = 0;

		$sQuery = "SELECT
        SHARE_ID,
        EMP_ID,
        SHARE_ACCESS
        FROM ".$InrConn->GetPrefix()."VIEW_SHAREHOLDER
        WHERE (SHARE_AVAIL = ?)
        AND (SHARE_ACCESS >= ?)
        AND (SHARE_ID = ?);";

        if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniShareholderIndex))
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

//WARNIGN:To be removed in future versions
function ShareholderGeneralSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniShareholderIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
    ($IniShareholderIndex > 0) &&
    ($IniAvail > 0 && $IniAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rStatement = 0;

		$sQuery = "SELECT 
        SHARE_ID,
        SHARE_ACCESS,
        EMP_ID,
        EMP_ACCESS,
        EMP_DATA_ID,
        EMP_DATA_ACCESS,
        EMP_DATA_SALARY, 
        EMP_DATA_BDAY, 
        EMP_DATA_NAME, 
        EMP_DATA_SURNAME, 
        EMP_DATA_EMAIL,
        EMP_DATA_PN,
        EMP_DATA_SN,
        EMP_POS_ID,
        EMP_POS_ACCESS
        EMP_POS_TITLE,
        COMP_ID,
        COMP_ACCESS,
        COMP_DATA_ID,
        COMP_DATA_ACCESS,
        COMP_DATA_TITLE,
        COU_ID,
        COU_ACCESS,
        COU_DATA_ID,
        COU_DATA_ACCESS
        COU_DATA_TITLE,
        COU_DATA_TAX,
        COU_DATA_IR,
        COU_DATA_DATE,
        COUN_DATA_TITLE
        FROM ".$InrConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL 
        WHERE (SHARE_AVAIL = ?
        AND EMP_AVAIL = ? 
        AND EMP_DATA_AVAIL = ? 
        AND EMP_POS_AVAIL = ?
        AND COMP_AVAIL = ?
        AND COMP_DATA_AVAIL = ?
        AND COU_AVAIL = ?
        AND COU_DATA_AVAIL = ?
        AND COUN_AVAIL = ?
        AND COUN_DATA_AVAIL = ?
        AND SHARE_ACCESS >= ?
        AND EMP_ACCESS >= ?
        AND EMP_DATA_ACCESS >= ?
        AND EMP_POS_ACCESS >= ?
        AND COMP_ACCESS >= ?
        AND COMP_DATA_ACCESS >= ?
        AND COU_ACCESS >= ?
        AND COU_DATA_ACCESS >= ?
        AND COUN_ACCESS >= ?
        AND COUN_DATA_ACCESS >= ?
        AND SHARE_ID = ?);";

        if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiiiiiiiiiiiiiiiiiii", $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniUserAccess, $IniShareholderIndex))
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