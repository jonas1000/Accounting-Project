<?php
//Render element <select> with the Employee Position array result from query
function RenderEmployeePosSelectRow(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail) : void
{
	if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rResult = EmployeePosSelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

		if(!empty($rResult) && ($rResult->num_rows > 0))
		{
			print("<select name='EmployeePosition'>");
			foreach($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
				printf("<option value='%s'>%s</option>", $aDataRow['EMP_POS_ID'], $aDataRow['EMP_POS_TITLE']);
			print("</select>");

			$rResult->free();
		}
		else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __FUNCTION__, __LINE__);
}

//Render element <select> with the Employee Position array result from query
function RenderEmployeePosSelectRowCheck(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail, int $IniSelected) : void
{
	if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rResult = EmployeePosSelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

		if(!empty($rResult) && ($rResult->num_rows > 0))
		{
			print("<select name='EmployeePosition'>");
			foreach($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
				printf("<option value='%s' %s>%s</option>", $aDataRow['EMP_POS_ID'], ($IniSelected == (int) $aDataRow['EMP_POS_ID'] ? "selected" : ""), $aDataRow['EMP_POS_TITLE']);
			print("</select>");

			$rResult->free();
		}
		else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __FUNCTION__, __LINE__);
}
?>