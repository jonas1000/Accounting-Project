<?php
//Render element <select> with the County array result from query
function RenderCountySelectRow(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		CountySelectElemRetriever($InDBConn, $IniUserAccessLevel, $IniIsAvailIndex);

		print("<select name='County'>");

		foreach($InDBConn->GetResult() as $CountyRow => $CountyData)
			printf("<option value='%s'>%s</option>", $CountyData['COU_ID'], $CountyData['COU_DATA_TITLE']);

		print("</select>");
	}
}

//Render element <select> with the County array result from query
function RenderCountySelectRowCheck(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex, int $IniSelected = 0) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		CountySelectElemRetriever($InDBConn, $IniUserAccessLevel, $IniIsAvailIndex);

		print("<select name='County'>");

		foreach ($InDBConn->GetResult() as $CountyRow => $CountyData)
		printf("<option value='%s' %s>%s</option>", $CountyData['COU_ID'], ($IniSelected == (int) $CountyData['COU_ID'] ? "selected" : ""), $CountyData['COU_DATA_TITLE']);

		print("</select>");
	}
}
?>