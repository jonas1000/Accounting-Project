<?php
//Render element <select> with the Employee array result from query
function RenderEmployeeSelectRow(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail) : void
{
	if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rResult = EmployeeSelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

		if(!empty($rResult) && ($rResult->num_rows > 0))
		{
			print("<select name='Employee'>");
			foreach($rResult->fetch_all((MYSQLI_ASSOC)) as $aDataRow)
				printf("<option value='%s'>%s</option>", $aDataRow['EMP_ID'], $aDataRow['EMP_DATA_NAME']);
			print("</select>");

			$rResult->free();
		}
		else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __FUNCTION__, __LINE__);
}

//Render element <select> with the Employee array result from query
function RenderEmployeeSelectRowCheck(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail, int $IniSelected = 0) : void
{
	if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']) && ($IniSelected > 0))
	{
		$rResult = EmployeeSelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

		if(!empty($rResult) && ($rResult->num_rows > 0))
		{
			print("<select name='Employee'>");
			foreach($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
				printf("<option value='%s' %s>%s</option>", $aDataRow['EMP_ID'], ($IniSelected == (int) $aDataRow['EMP_ID'] ? "selected" : ""), $aDataRow['EMP_DATA_NAME']);
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