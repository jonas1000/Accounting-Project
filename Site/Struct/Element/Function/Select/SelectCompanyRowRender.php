<?php
//Render element <select> with the Company array result from query
function RenderCompanySelectRow(object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			CompanyFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='Company'>");

			foreach($InDBConn->GetResult() as $CompRow => $CompData)
				printf("<option value='". $CompData['COMP_ID'] ."'>". $CompData['COMP_DATA_TITLE'] ."</option>");

			printf("</select>");
		}
	}
}
?>
