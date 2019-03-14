<?php
function CompanyEditParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyIndex, int &$IniCountyIndex, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
    if(($IniCompanyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
    {
        $sDBQuery = "";
        $sPrefix = $InDBConn->GetPrefix();

        $sDBQuery = "UPDATE 
        ".$sPrefix. "VIEW_COMPANY
        SET
        ".$sPrefix."VIEW_COMPANY.COU_ID = ".$IniCountyIndex.",
        ".$sPrefix."VIEW_COMPANY.COMP_ACCESS = ".$IniContentAccessLevelIndex."
        WHERE
        (".$sPrefix."VIEW_COMPANY.COMP_ID = ".$IniCompanyIndex."
        AND
        ".$sPrefix."VIEW_COMPANY.COMP_ACCESS > ".($IniUserAccessLevelIndex - 1)."
        AND
        ".$sPrefix."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex.");";

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

function CompanyDataEditParser(ME_CDBConnManager &$InDBConn, int &$IniCompanyDataIndex, string &$InsName, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
    if(ME_MultyCheckEmptyType($InsName, $InsDate))
    {
        if(($IniCompanyDataIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
        {
            $sDBQuery = "";
            $sPrefix = $InDBConn->GetPrefix();

            $sDBQuery = "UPDATE 
            ".$sPrefix."VIEW_COMPANY_DATA
            SET
            ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE = \"".$InsName."\",
            ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE = \"".$InsDate."\"
            WHERE
            (".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID = ".$IniCompanyDataIndex."
            AND
            ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID > ".($IniUserAccessLevelIndex - 1)."
            AND
            ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ".$IniIsAvailIndex.");";

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