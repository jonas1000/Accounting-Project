<?php
 //Render element <select> with the Country array result from query
function RenderCountrySelectRow(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
    if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1))) 
    {
        CountrySelectElemRetriever($InDBConn, $IniUserAccessLevel, $IniIsAvailIndex);

        printf("<select name='Country'>");

        foreach($InDBConn->GetResult() as $CountryRow => $CountryData)
            printf("<option value='" . $CountryData['COUN_ID'] . "'>" . $CountryData['COUN_DATA_TITLE'] . "</option>");

        printf("</select>");
    }
}

 //Render element <select> with the Country array result from query
function RenderCountrySelectRowCheck(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex, int &$IniSelected) : void
{
    if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)) && ($IniSelected > 0)) 
    {
        CountrySelectElemRetriever($InDBConn, $IniUserAccessLevel, $IniIsAvailIndex);

        printf("<select name='Country'>");

        foreach($InDBConn->GetResult() as $CountryRow => $CountryData)
            printf("<option value='" . $CountryData['COUN_ID'] . "' ".($IniSelected == (int) $CountryData['COUN_ID'] ? "selected" : "").">" . $CountryData['COUN_DATA_TITLE'] . "</option>");

        printf("</select>");
    }
}
?>