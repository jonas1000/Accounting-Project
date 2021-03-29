<?php
 //Render element <select> with the Company array result from query
function RenderCompanySelectRow(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail) : void
{
    if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE'])) 
    {
        $rResult = CompanySelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

        if(!empty($rResult) && ($rResult->num_rows > 0))
        {
            print("<select name='Company'>");
            foreach($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
                printf("<option value='%s'>%s</option>", $aDataRow['COMP_ID'], $aDataRow['COMP_DATA_TITLE']);
            print("</select>");

            $rResult->free();
        }
        else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __FUNCTION__, __LINE__);
}

function RenderCompanySelectRowCheck(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail, int $IniSelected) : void
{
    if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']) && ($IniSelected > 0)) 
    {
        $rResult = CompanySelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

        if(!empty($rResult) && ($rResult->num_rows > 0))
        {
            print("<select name='Company'>");
            foreach($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
                printf("<option value='%s' %s>%s</option>", $aDataRow['COMP_ID'], ($IniSelected == (int) $aDataRow['COMP_ID'] ? "selected" : ""), $aDataRow['COMP_DATA_TITLE']);
            print("</select>");

            $rResult->free();
        }
        else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __FUNCTION__, __LINE__);
}
?>