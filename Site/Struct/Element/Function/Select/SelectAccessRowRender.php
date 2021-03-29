<?php
//Render element <select> with the Access array result from query
function RenderAccessSelectRow(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess, int &$IniIsAvail) : void
{
    if (($IniUserAccess > 0) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
    {
        $rResult = AccessSelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

        if(!empty($rResult) && ($rResult->num_rows > 0))
        {
            print("<select name='Access'>");
            foreach ($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
                printf("<option value='%s'>%s</option>", $aDataRow['ACCESS_ID'], $aDataRow['ACCESS_TITLE']);
            print("</select>");

            $rResult->free();
        }
        else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __METHOD__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __METHOD__, __LINE__);
}

//Render element <select> with the Access array result from query
function RenderAccessSelectRowCheck(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess, int &$IniIsAvail, int &$IniSelected) : void
{
    if (CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']) && ($IniSelected > 0)) 
    {
        $rResult = AccessSelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

        if(!empty($rResult) && ($rResult->num_rows > 0))
        {
            print("<select name='Access'>");
            foreach ($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
                printf("<option value='%s' %s>%s</option>", $aDataRow['ACCESS_ID'], (($IniSelected == (int)$aDataRow['ACCESS_ID']) ? "selected" : ""), $aDataRow['ACCESS_TITLE']);
            print("</select>");

            $rResult->free();
        }
        else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __METHOD__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __METHOD__, __LINE__);
}
?>