<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");
require_once("Output/Retriever/EmployeeRetriever.php");

function HTMLEmployeeOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$rEmpListResult = 0;

	//Query to return the a list of employees
	if(!$rEmpListResult = EmployeeOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']))
		$InrLogHandle->AddLogMessage("Failed to get result from Customer Retriever" , __FILE__, __FUNCTION__, __LINE__);
	else
	{
		HTMLEmployeeOverviewDataBlock($rEmpListResult, $InrLogHandle, $IniUserAccess);

		$rEmpListResult->free();
	}
}

function HTMLEmployeeOverviewDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['CUSTOMER_SEARCH_TYPE'], $sSearchTypeSelected);
	
	//The toolbar for the buttons (tools)
	printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['Employee'], $GLOBALS['MODULE']['Add']);
	printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['Employee'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

	foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
	{
		if(((int) $aDataRow['EMP_DATA_ACCESS']) >= $IniUserAccess)
		{
			print("<div class='DataBlock'><form method='POST'>");

			//Data Row - employee title
			printf("<div><h5>%s %s</h5></div>", $aDataRow['EMP_DATA_NAME'], $aDataRow['EMP_DATA_SURNAME']);

			//Data Row - employee email
			printf("<div><div><b><p>Email</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_EMAIL']);

			//Data Row - employee salary
			printf("<div><div><b><p>Salary</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_SALARY']);

			//If the user has no access to this layer of data then ghost it
			if(((int) $aDataRow['EMP_POS_ACCESS']) >= $IniUserAccess)
			    //Data Row - employee title
				printf("<div><div><b><p>Title</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_POS_TITLE']);

			//Data Row - employee birth day
			printf("<div><div><b><p>Birth Day</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_BDAY']);

			//Data Row - employee phone number
			printf("<div><div><b><p>Phone Number</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_PN']);

			//Data Row - employee stable number
			printf("<div><div><b><p>Stable Number</p></b></div><div><p>%s</p></div></div>", $aDataRow['EMP_DATA_SN']);

			//Block of tools for the Data Row
			printf("<div><input type='hidden' name='EmpIndex' value='%d'>", $aDataRow['EMP_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['Employee'], $GLOBALS['MODULE']['Delete']);
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['Employee'], $GLOBALS['MODULE']['Edit']);

			print("</form></div>");

		}
	}
}
?>