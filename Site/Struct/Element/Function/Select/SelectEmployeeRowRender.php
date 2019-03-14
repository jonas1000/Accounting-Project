<?php
//Render element <select> with the Employee array result from query
function RenderEmployeeSelectRow(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		EmployeeFormRetriever($InDBConn, $IniUserAccessLevelIndex, $IniIsAvailIndex);

		printf("<select name='Employee'>");

		foreach($InDBConn->GetResult() as $EmpRow => $EmpData)
			printf("<option value='". $EmpData['EMP_ID'] ."'>". $EmpData['EMP_DATA_NAME'] ."</option>");

		printf("</select>");
	}
}

//Render element <select> with the Employee array result from query
function RenderEmployeeSelectRowCheck(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex, int &$IniSelected) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)) && ($IniSelected > 0))
	{
		EmployeeFormRetriever($InDBConn, $IniUserAccessLevelIndex, $IniIsAvailIndex);

		printf("<select name='Employee'>");

		foreach($InDBConn->GetResult() as $EmpRow => $EmpData)
			printf("<option value='%s' %s>%s</option>", $EmpData['EMP_ID'], ($IniSelected == (int) $EmpData['EMP_ID'] ? "selected" : ""), $EmpData['EMP_DATA_NAME']);

		printf("</select>");
	}
}
?>