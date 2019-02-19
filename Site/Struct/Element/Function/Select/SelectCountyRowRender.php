<?php
//Render element <select> with the County array result from query
function RenderCountySelectRow(object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			CountyFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='County'>");

			foreach($InDBConn->GetResult() as $CountyRow => $CountyData)
				printf("<option value='". $CountyData['COU_ID'] ."'>". $CountyData['COU_DATA_TITLE'] ."</option>");

			printf("</select>");
		}
	}
}

//Render element <select> with the County array result from query
function RenderCountySelectRowCheck(object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex, string $InsSelected) : void
{
	if (ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex)) {
		if ($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1))) {
			CountyFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='County'>");

			foreach ($InDBConn->GetResult() as $CountyRow => $CountyData)
				printf("<option value='" . $CountyData['COU_ID'] . "'" . ($InsSelected == $CountyData['COU_ID'] ? "selected" : "") . ">" . $CountyData['COU_DATA_TITLE'] . "</option>");

			printf("</select>");
		}
	}
}
?>
