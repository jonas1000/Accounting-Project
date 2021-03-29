<?php
//Render element <select> with the County array result from query
function RenderCountySelectRow(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail) : void
{
	if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rResult = CountySelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);

		if(!empty($rResult) && ($rResult->num_rows > 0))
		{
			print("<select name='County'>");
			foreach($rResult as $aDataRow)
				printf("<option value='%s'>%s</option>", $aDataRow['COU_ID'], $aDataRow['COU_DATA_TITLE']);
			print("</select>");

			$rResult->free();
		}
		else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __METHOD__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __METHOD__, __LINE__);
}

//Render element <select> with the County array result from query
function RenderCountySelectRowCheck(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniIsAvail, int $IniSelected = 0) : void
{
	if(CheckAccessRange($IniUserAccess) && ($IniIsAvail > 0 && $IniIsAvail <= $GLOBALS['AVAILABLE_ARRAY_SIZE']))
	{
		$rResult = CountySelectElemRetriever($InrConn, $InrLogHandle, $IniUserAccess, $IniIsAvail);
		
		if(!empty($rResult) && ($rResult->num_rows > 0))
		{
			print("<select name='County'>");
			foreach ($rResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
				printf("<option value='%s' %s>%s</option>", $aDataRow['COU_ID'], ($IniSelected == (int) $aDataRow['COU_ID'] ? "selected" : ""), $aDataRow['COU_DATA_TITLE']);
			print("</select>");

			$rResult->free();
		}
		else
            $InrLogHandle->AddLogMessage("result cannot return empty list", __FILE__, __METHOD__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("One or more of the input parameters are out of range", __FILE__, __METHOD__, __LINE__);
}
?>