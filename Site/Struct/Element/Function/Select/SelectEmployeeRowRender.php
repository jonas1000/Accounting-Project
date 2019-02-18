<?php
//Render element <select> with the Employee array result from query
function RenderEmployeeSelectRow(Object &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			EmployeeFormRetriever($InDBConn, $IniAccessIndex, $IniIsAvailIndex);

			printf("<select name='Employee'>");

			foreach($InDBConn->GetResult() as $EmpRow => $EmpData)
				printf("<option value='". $EmpData['EMP_ID'] ."'>". $EmpData['EMP_DATA_NAME'] ."</option>");

			printf("</select>");
		}
	}
}
?>
