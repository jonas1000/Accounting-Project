<?php
//Render element <select> with the Employee Position array result from query
function RenderEmployeePosSelectRow(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		EmployeePosFormRetriever($InDBConn, $IniUserAccessLevelIndex, $IniIsAvailIndex);

		print("<select name='EmployeePosition'>");

		foreach($InDBConn->GetResult() as $EmpPosRow => $EmpPosData)
			printf("<option value='%s'>%s</option>", $EmpPosData['EMP_POS_ID'], $EmpPosData['EMP_POS_TITLE']);

		print("</select>");
	}
}

//Render element <select> with the Employee Position array result from query
function RenderEmployeePosSelectRowCheck(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex, int &$IniSelected) : void
{
	if(($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		EmployeePosFormRetriever($InDBConn, $IniUserAccessLevelIndex, $IniIsAvailIndex);

		print("<select name='EmployeePosition'>");

		foreach($InDBConn->GetResult() as $EmpPosRow => $EmpPosData)
			printf("<option value='%s' %s>%s</option>", $EmpPosData['EMP_POS_ID'], ($IniSelected == (int) $EmpPosData['EMP_POS_ID'] ? "selected" : ""), $EmpPosData['EMP_POS_TITLE']);

		print("</select>");
	}
}
?>