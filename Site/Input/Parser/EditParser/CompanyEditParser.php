<?php
function CompanyEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompanyIndex, int $IniCountyIndex, int $IniContentAccess, int $IniAvail)
{
    if(($IniCountyIndex > 0) &&
    ($IniCompanyIndex > 0) &&
    CheckAccessRange($IniContentAccess) &&
    CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
    {
        $sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_COMPANY_EDIT
        SET 
        COU_ID = ?,
        COMP_ACCESS_ID = ?,
        COMP_AVAIL_ID = ?
        WHERE 
        COMP_ID = ?;";

		//Create the statement query
        if($rStatement = $InrConn->CreateStatement($sQuery))
        {
            //Check if the statement binded the variables, else add an error
            if($rStatement->bind_param("iiii", $IniCountyIndex, $IniContentAccess, $IniAvail, $IniCompanyIndex))
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

function CompanyDataEditParser(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCompanyDataIndex, string &$InsName, string &$InsDate, int $IniContentAccess, int $IniAvail)
{
    if(!ME_MultyCheckEmptyType($InsName, $InsDate) &&
    ($IniCompanyDataIndex > 0) &&
    CheckAccessRange($IniContentAccess) &&
    CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
    {
        $sQuery = "UPDATE ".$InrConn->GetPrefix()."VIEW_COMPANY_DATA_EDIT 
        SET 
        COMP_DATA_TITLE = ?,
        COMP_DATA_DATE = ?,
        COMP_DATA_ACCESS_ID = ?,
        COMP_DATA_AVAIL_ID = ?
        WHERE 
        COMP_DATA_ID = ?;";

        //Create the statement query
        if($rStatement = $InrConn->CreateStatement($sQuery))
        {
            //Check if the statement binded the variables, else add an error
            if($rStatement->bind_param("ssiii", $InsName, $InsDate, $IniContentAccess, $IniAvail, $IniCompanyDataIndex))
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