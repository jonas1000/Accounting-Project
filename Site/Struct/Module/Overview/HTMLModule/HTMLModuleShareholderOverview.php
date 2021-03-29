<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");

function HTMLShareholderOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
	$rResult = 0;

	if(!$rResult = ShareholderOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']))
		$InrLogHandle->AddLogMessage("Failed to get result from shareholder list Retriever" , __FILE__, __FUNCTION__, __LINE__);
	else
	{
		HTMLShareholderDataBlock($rResult, $InrLogHandle, $IniUserAccess);

		$rResult->free();
	}
	
}

function HTMLShareholderDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{ 
	$sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['EMPLOYEE_POSITION_SEARCH_TYPE'], $sSearchTypeSelected);

	//The toolbar for the buttons (tools)
	printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['Shareholder'], $GLOBALS['MODULE']['Add']);
	printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['Shareholder'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

	foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
	{
		print("<div class='DataBlock'><form method='POST'>");

		//Title
		printf("<div><h5>%s %s</h5></div>", $aDataRow['EMP_DATA_NAME'], $aDataRow['EMP_DATA_SURNAME']);

		//Data Row
		printf("<div><div><b><p>Salary</p></b></div><div><p>%f</p></div></div>", $aDataRow['EMP_DATA_SALARY']);

		//Data Row
		printf("<div><div><b><p>Birth Date</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_BDAY']);

		//Data Row
		printf("<div><div><b><p>Email</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_EMAIL']);

		//Data Row
		printf("<div><div><b><p>Title</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_POS_TITLE']);

		//Button list for specific Data Row
		printf("<div><input type='hidden' name='ShareIndex' value='%d'>", $aDataRow['SHARE_ID']);
		printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['Shareholder'], $GLOBALS['MODULE']['Delete']);
		printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['Shareholder'], $GLOBALS['MODULE']['Edit']);

		print("</form></div>");
	}
}
?>
