<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");
require_once("Output/Retriever/CustomerRetriever.php");

function HTMLCustomerOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$rCustListResult = 0;

	if(!$rCustListResult = CustomerOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']))
		$InrLogHandle->AddLogMessage("Failed to get result from Customer Retriever" , __FILE__, __FUNCTION__, __LINE__);
	else
	{		
		HTMLCustomerOverviewDataBlock($rCustListResult, $InrLogHandle, $IniUserAccess);

		$rCustListResult->free();
	}
}

function HTMLCustomerOverviewDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['CUSTOMER_SEARCH_TYPE'], $sSearchTypeSelected);

	//The toolbar for the buttons (tools)
	printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['Customer'], $GLOBALS['MODULE']['Add']);
	printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['Customer'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

	foreach($InrResult as $aDataRow)
	{
		if(((int) $aDataRow['CUST_DATA_ACCESS']) >= $IniUserAccess)
		{
			print("<div class='DataBlock'><form method='POST'><div>");

			printf("<div><h5>%s %s</h5></div>", $aDataRow['CUST_DATA_NAME'], $aDataRow['CUST_DATA_SURNAME']);

			//Data Row - customer email
			printf("<div><div><b><p>Email</p></b></div><div><p>%s</p></div></div>", (empty($aDataRow['CUST_DATA_EMAIL']) ? "None" : $aDataRow['CUST_DATA_EMAIL']));

			//Data Row - customer phone number
			printf("<div><div><b><p>Phone number</p></b></div><div><p>%s</p></div></div>", (empty($aDataRow['CUST_DATA_PN']) ? "None" : $aDataRow['CUST_DATA_PN']));

			//Data Row - customer stable number
			printf("<div><div><b><p>Stable number</p></b></div><div><p>%s</p></div></div>", (empty($aDataRow['CUST_DATA_SN']) ? "None" : $aDataRow['CUST_DATA_SN']));

			//Data Row - customer VAT
			printf("<div><div><b><p>VAT</p></b></div><div><p>%s</p></div></div>", (empty($aDataRow['CUST_DATA_VAT']) ? "None" : $aDataRow['CUST_DATA_VAT']));

			//Data Row - customer Address
			printf("<div><div><b><p>Address</p></b></div><div><p>%s</p></div></div>", (empty($aDataRow['CUST_DATA_ADDR']) ? "None" : $aDataRow['CUST_DATA_ADDR']));

			//Data Row - customer note
			printf("<div><div><b><p>Note</p></b></div><div><p>%s</p></div></div></div>", (empty($aDataRow['CUST_DATA_NOTE']) ? "None" : $aDataRow['CUST_DATA_NOTE']));

			//input button types
			printf("<div><input type='hidden' name='CustIndex' value='%s'>", $aDataRow['CUST_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['Customer'], $GLOBALS['MODULE']['Delete']);
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['Customer'], $GLOBALS['MODULE']['Edit']);

			print("</form></div>");
		}
	}
}
?>
