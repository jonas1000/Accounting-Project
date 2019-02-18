<?php
//Render element <select> with the Employee Position array result from query
function RenderEmployeePosSelectRow(Object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			EmployeePosFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='Position'>");

			foreach($InDBConn->GetResult() as $EmpPosRow => $EmpPosData)
				printf("<option value='". $EmpPosData['EMP_POS_ID'] ."'>". $EmpPosData['EMP_POS_TITLE'] ."</option>");

			printf("</select>");
		}
	}
}
?>
