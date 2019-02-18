<?php

//-------------<FUNCTIONS>-------------//
//Render element <select> with the Access array result from query
function RenderAccessSelectRow(object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			AccessFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='Access'>");

			foreach($InDBConn->GetResult() as $AccessRow => $AccessData)
				printf("<option value='". $AccessData['ACCESS_ID'] ."'>". $AccessData['ACCESS_TITLE'] ."</option>");

			printf("</select>");
		}
	}
}

?>
