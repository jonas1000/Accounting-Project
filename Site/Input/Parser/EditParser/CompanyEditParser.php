<?php
function CompanyEditParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniCountyIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
    if(($IniCountyIndex > 0) && ($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
    {
        $sDBQuery = "";
        $sPrefix = $InDBConn->GetPrefix();

        $sDBQuery = "UPDATE 
        ".$sPrefix."VIEW_COMPANY_EDIT
        SET
        ".$sPrefix."VIEW_COMPANY_EDIT.COU_ID = ".$IniCountyIndex.",
        ".$sPrefix."VIEW_COMPANY_EDIT.COMP_ACCESS_ID = ".$IniContentAccessLevelIndex."
        WHERE
        (".$sPrefix."VIEW_COMPANY_EDIT.COMP_AVAIL_ID = ".$IniIsAvailIndex.")
        AND
        (".$sPrefix."VIEW_COMPANY_EDIT.COMP_ID = ".$IniCompanyIndex.");";

        $InDBConn->ExecQuery($sDBQuery, TRUE);

        if(!$InDBConn->HasError()) 
        {
            if($InDBConn->HasWarning())
                throw new Exception($InDBConn->GetWarning());
        } 
        else
            throw new Exception($InDBConn->GetError());

        unset($sDBQuery, $sPrefix);
    } 
    else
        throw new Exception("Input parameters do not meet requirements range");
} 

function CompanyDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyDataIndex, string &$InsName, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
    if(!ME_MultyCheckEmptyType($InsName, $InsDate))
    {
        if(($IniCompanyDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
        {
            $sDBQuery = "";
            $sPrefix = $InDBConn->GetPrefix();

            $sDBQuery = "UPDATE 
            ".$sPrefix."VIEW_COMPANY_DATA_EDIT
            SET
            ".$sPrefix."VIEW_COMPANY_DATA_EDIT.COMP_DATA_TITLE = \"".$InsName."\",
            ".$sPrefix."VIEW_COMPANY_DATA_EDIT.COMP_DATA_DATE = \"".$InsDate."\",
            ".$sPrefix."VIEW_COMPANY_DATA_EDIT.COMP_DATA_ACCESS_ID = ".$IniContentAccessLevelIndex."
            WHERE
            (".$sPrefix."VIEW_COMPANY_DATA_EDIT.COMP_DATA_AVAIL_ID = ".$IniIsAvailIndex.")
            AND
            (".$sPrefix."VIEW_COMPANY_DATA_EDIT.COMP_DATA_ID = ".$IniCompanyDataIndex.");";

            $InDBConn->ExecQuery($sDBQuery, true);

            if(!$InDBConn->HasError()) 
            {
                if($InDBConn->HasWarning())
                    throw new Exception($InDBConn->GetWarning());
            } 
            else
                throw new Exception($InDBConn->GetError());

            unset($sDBQuery, $sPrefix);
        }
        else
            throw new Exception("Input parameters do not meet requirements range");
    } 
    else
        throw new Exception("Input parameters are empty");
}
?>