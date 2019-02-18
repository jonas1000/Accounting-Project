<?php
//Render element <select> with the Country array result from query
function RenderCountrySelectRow(object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			CountryFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='Country'>");

			foreach($InDBConn->GetResult() as $CountryRow => $CountryData)
				printf("<option value='". $CountryData['COUN_ID'] ."'>". $CountryData['COUN_DATA_TITLE'] ."</option>");

			printf("</select>");
		}
	}
}
?>
