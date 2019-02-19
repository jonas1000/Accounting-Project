<?php
function CompanyEditParser(CDBConnManager &$InDBConn, int &$IniCompIndex, int &$IniCouIndex, int &$IniAccessIndex) : void
{
    if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex))
    {
        if(($IniCompIndex > 0) && ($IniAccessIndex > 0))
        {
            $sDBQuery = NULL;

            $sDBQuery = "UPDATE ".$InDBConn->GetPrefix(). "VIEW_COMPANY
            SET
            ".$InDBConn->GetPrefix() . "VIEW_COMPANY.COU_ID = ".$IniCouIndex.",
            ".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ACCESS = ".$IniAccessIndex."
            WHERE
            (".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ID = ".$IniCompIndex.");";

            $InDBConn->ExecQuery($sDBQuery, TRUE);

            if (!$InDBConn->HasError()) 
            {
                if ($InDBConn->HasWarning())
                    throw new Exception("warning detected: " . $InDBConn->GetWarning());
            } 
            else
                throw new Exception("Error: " . $InDBConn->GetError());

            unset($sDBQuery);
        } 
        else
            throw new Exception("Input parameters do not meet requirements range");
    } 
    else
        throw new Exception("Input parameters are empty");
} 

function CompanyDataEditParser(CDBConnManager &$InDBConn, int &$IniCompDataIndex, string &$InsName, string &$InsDate, int &$IniAccessIndex) : void
{
    if (ME_MultyCheckEmptyType($InDBConn, $IniCompDataIndex, $InsName, $InsDate, $IniAccessIndex)) 
    {
        if (($IniCompDataIndex > 0) && ($IniAccessIndex > 0)) 
        {
            $sDBQuery = NULL;

            $sDBQuery = "UPDATE ".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA
            SET
            ".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_TITLE = \"".$InsName."\",
            ".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_DATE = \"".$InsDate."\"
            WHERE
            (".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_ID = ".$InDBConn->GetLastQueryID().");";

            $InDBConn->ExecQuery($sDBQuery, true);

            if (!$InDBConn->HasError()) 
            {
                if ($InDBConn->HasWarning())
                    throw new Exception("warning detected: " . $InDBConn->GetWarning());
            } 
            else
                throw new Exception("Error: " . $InDBConn->GetError());

            unset($sDBQuery);
        }
        else
            throw new Exception("Input parameters do not meet requirements range");
    } 
    else
        throw new Exception("Input parameters are empty");
}
?>