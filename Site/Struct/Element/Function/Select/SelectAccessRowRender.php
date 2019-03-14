<?php
//-------------<FUNCTIONS>-------------//
//Render element <select> with the Access array result from query
function RenderAccessSelectRow(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
    if (($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1))) 
    {
        AccessFormRetriever($InDBConn, $IniUserAccessLevelIndex, $IniIsAvailIndex);

        printf("<select name='Access'>");

        foreach ($InDBConn->GetResult() as $AccessRow => $AccessData)
            printf("<option value='" . $AccessData['ACCESS_ID'] . "'>" . $AccessData['ACCESS_TITLE'] . "</option>");

        printf("</select>");
    }
}

//Render element <select> with the Access array result from query
function RenderAccessSelectRowCheck(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex, int &$IniSelected) : void
{
    if (($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)) && ($IniSelected > 0)) 
    {
        AccessFormRetriever($InDBConn, $IniUserAccessLevelIndex, $IniIsAvailIndex);

        printf("<select name='Access'>");

        foreach ($InDBConn->GetResult() as $AccessRow => $AccessData)
            printf("<option value='" . $AccessData['ACCESS_ID'] . "' " . (($IniSelected == (int)$AccessData['ACCESS_ID']) ? "selected" : "") . ">" . $AccessData['ACCESS_TITLE'] . "</option>");

        printf("</select>");
    }
}
?>