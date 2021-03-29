<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");
require_once("Output/Retriever/CountyRetriever.php");

function HTMLCountyOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$rCouListResult = 0;
	$sSearchType = (isset($_GET['SearchType'])) ? $_GET['SearchType'] : "" ;
	$sSearchQuery = (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "";

	if(!$rCouListResult = CountyOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $sSearchType, $sSearchQuery))
		$InrLogHandle->AddLogMessage("Failed to get result from County Retriever" , __FILE__, __FUNCTION__, __LINE__);
	else
	{
		HTMLCountryOverviewDataBlock($rCouListResult, $InrLogHandle, $IniUserAccess);

		$rCouListResult->free();
	}
}

function HTMLCountryOverviewDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['COUNTY_SEARCH_TYPE'], $sSearchTypeSelected);

	//The toolbar for the buttons (tools)
	printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX'], $GLOBALS['MODULE']['Add']);
	printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['County'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

	foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
	{
		if(((int) $aDataRow['COU_DATA_ACCESS']) >= $IniUserAccess)
		{
			print("<div class='DataBlock'><form method='POST'>");

			//Data Row - county title
			printf("<div><h5>%s</h5></div>", $aDataRow['COU_DATA_TITLE']);

			//Data Row - county tax
			printf("<div><div><b><p>Tax</p></b></div><div><p>%s</p></div></div>", $aDataRow['COU_DATA_TAX']);

			//Data Row- county interest rate
			printf("<div><div><b><p>Interest Rate</p></b></div><div><p>%s</p></div></div>", $aDataRow['COU_DATA_IR']);

			//Button list for specific Data Row
			printf("<div><input type='hidden' name='CouIndex' value='%d'>", $aDataRow['COU_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['County'], $GLOBALS['MODULE']['Delete']);
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['County'], $GLOBALS['MODULE']['Edit']);

			print("</form></div>");
		}
		else
			$InrLogHandle->AddLogMessage("Access was denied, not enought privilege to retrieve data from query", __FILE__, __FUNCTION__, __LINE__);
	}
}
?>