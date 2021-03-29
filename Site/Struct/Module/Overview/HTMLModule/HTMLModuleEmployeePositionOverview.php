<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");
require_once("Output/Retriever/EmployeeRetriever.php");

function HTMLEmployeePositionOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$rEmpPosListResult = 0;

	if(!$rEmpPosListResult = EmployeePositionOverviewRetriever($InrConn, $InrLogHandle,  $IniUserAccess, $GLOBALS['AVAILABLE']['Show']))
		$InrLogHandle->AddLogMessage("Failed to get result from Customer Retriever" , __FILE__, __FUNCTION__, __LINE__);
	else
	{
		HTMLEmployeePositionOverviewDataBlock($rEmpPosListResult, $InrLogHandle, $IniUserAccess);

		$rEmpPosListResult->free();
	}
}

function HTMLEmployeePositionOverviewDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['EMPLOYEE_POSITION_SEARCH_TYPE'], $sSearchTypeSelected);

	//The toolbar for the buttons (tools)
	printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['EmployeePosition'], $GLOBALS['MODULE']['Add']);
	printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['EmployeePosition'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

	foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
	{
		if(((int) $aDataRow['EMP_POS_ACCESS'] >= $IniUserAccess))
		{
			print("<div class='DataBlock'><form method='POST'>");

			printf("<div><h5>%s</h5></div>", $aDataRow['EMP_POS_TITLE']);

			//Button list for specific Data Row
			printf("<div><input type='hidden' name='EmpPosIndex' value='%d'>", $aDataRow['EMP_POS_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['EmployeePosition'], $GLOBALS['MODULE']['Delete']);
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['EmployeePosition'], $GLOBALS['MODULE']['Edit']);

			print("</form></div>");
		}
	}
}
?>