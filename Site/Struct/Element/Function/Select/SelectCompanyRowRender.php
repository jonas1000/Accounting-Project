<?php
 //Render element <select> with the Company array result from query
function RenderCompanySelectRow(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
    if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1))) 
    {
        CompanySelectElemRetriever($InDBConn, $IniUserAccessLevel, $IniIsAvailIndex);

        print("<select name='Company'>");

        foreach($InDBConn->GetResult() as $CompRow => $CompData)
            printf("<option value='%s'>%s</option>", $CompData['COMP_ID'], $CompData['COMP_DATA_TITLE']);

        print("</select>");
    }
}

function RenderCompanySelectRowCheck(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex, int &$IniSelected) : void
{
    if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)) && ($IniSelected > 0)) 
    {
        CompanySelectElemRetriever($InDBConn, $IniUserAccessLevel, $IniIsAvailIndex);

        print("<select name='Company'>");

        foreach($InDBConn->GetResult() as $CompRow => $CompData)
            printf("<option value='%s' %s>%s</option>", $CompData['COMP_ID'], ($IniSelected == (int) $CompData['COMP_ID'] ? "selected" : ""), $CompData['COMP_DATA_TITLE']);

        print("</select>");
    }
}
?>