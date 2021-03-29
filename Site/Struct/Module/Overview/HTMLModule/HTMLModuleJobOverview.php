<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");

function HTMLJobPITTransOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['JobIndex']))
	{
		if(!empty($_POST['JobIndex']) && is_numeric($_POST['JobIndex']))
		{
			$iJobIndex = (int) $_POST['JobIndex'];

			$rResult = 0;

			if(!$rResult = JobPITRetriever($InrConn, $InrLogHandle, $iJobIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']))
				$InrLogHandle->AddLogMessage("Failed to get result from Job transtaction Retriever" , __FILE__, __FUNCTION__, __LINE__);
			else
			{
				HTMLJobPITTransOverviewDataBlock($rResult, $InrLogHandle, $IniUserAccess, $iJobIndex);

				$rResult->free();
			}
		}
	}
}

function HTMLJobPITTransOverviewDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniJobIndex) : void
{
	//The toolbar for the buttons (tools)
	print("<div class='ContentToolBar'><form method='POST'>");
	printf("<input type='hidden' name='JobIndex' value='%d' required>", $IniJobIndex);
	printf("<b><input class='Input-Left' type='submit' value='ADD' formaction='.?MenuIndex=%d&Module=%d&SubModule=0'></b>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Add']);
	print("</form></div>");

	foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
	{	
		if(((int) $aDataRow['JOB_PIT_ACCESS']) >= $IniUserAccess)
		{
			//DATA BLOCK
			print("<div class='DataBlock'><form method='POST'>");

			//Data Row
			printf("<div><h5>Transaction</h5></div><div><div><b><p>Payment</p></b></div><div style='color:rgba(0,150,0,1)'><p>+%f</p></div></div>", $aDataRow['JOB_PIT_PAYMENT']);

			//Data Row
			printf("<div><div><b><p>Date</p></b></div<div><p>%s</p></div></div>", $aDataRow['JOB_PIT_DATE']);

			//Button list for specific Data Row
			printf("<div><input type='hidden' name='JobPITIndex' value='%d'>", $aDataRow['JOB_PIT_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d&SubModule=%s'>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Extend'], $GLOBALS['MODULE']['Delete']);
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d&SubModule=%s'></div>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Extend'], $GLOBALS['MODULE']['Edit']);

			print("</form></div>");
		}
	}
}

function HTMLJobOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$rJobListResult = 0;

	if(!$rJobListResult = JobOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']))
		$InrLogHandle->AddLogMessage("Failed to get result from Job transtaction Retriever" , __FILE__, __FUNCTION__, __LINE__);
	else
	{
		HTMLJobOverviewDataBlock($InrConn, $rJobListResult, $InrLogHandle, $IniUserAccess);

		$rJobListResult->free();
	}
}

function HTMLJobOverviewDataBlock(ME_CDBConnManager &$InrConn, mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	$sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['EMPLOYEE_POSITION_SEARCH_TYPE'], $sSearchTypeSelected);

	//The toolbar for the buttons (tools)
	printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Add']);
	printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['Job'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

	foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aJobRow)
	{
		if(((int) $aJobRow['JOB_DATA_ACCESS']) >= $IniUserAccess)
		{
			$iJobIndex = (int) $aJobRow['JOB_ID'];

			$bIsJobIncOutSameAccess = (BOOL) $aJobRow['JOB_INC_ACCESS'] == $aJobRow['JOB_OUT_ACCESS'];

			print("<div class='DataBlock'><form method='POST'>");

			//Title
			print("<div>");
			printf("<h5>%s</h5>", $aJobRow['JOB_DATA_TITLE']);
			print("</div>");

			if(((int) $aJobRow['COMP_DATA_ACCESS']) >= $IniUserAccess)
				//Data Row
				printf("<div><div><b><p>Company</p></b></div><div><p>%s</p></div></div>", $aJobRow['COMP_DATA_TITLE']);

			//Data Row
			printf("<div><div><b><p>Job Date</p></b></div><div><p>%s</p></div></div>", $aJobRow['JOB_DATA_DATE']);

			if(((int)($aJobRow['JOB_INC_ACCESS'])) >= $IniUserAccess)
			{
				//Data Row
				printf("<div><div><b><p>Price</p></b></div><div><p>%s %s</p></div></div>", $aJobRow['JOB_INC_PRICE'], $GLOBALS['CURRENCY_SYMBOL']);

				//Data Row
				printf("<div><div><b><p>Payment in advance</p></b></div><div style='color:rgba(0,230,0,1)'><p>+%s %s</p></div></div>", $aJobRow['JOB_INC_PIA'], $GLOBALS['CURRENCY_SYMBOL']);
			}

			if(((int) $aJobRow['JOB_OUT_ACCESS']) >= $IniUserAccess)
			{
				//Data Row
				printf("<div><div><b><p>Expences</p></b></div><div style='color:rgba(230,0,0,1)'><p>%s %s</p></div></div>", $aJobRow['JOB_OUT_EXPENSES'], $GLOBALS['CURRENCY_SYMBOL']);

				//Data Row
				printf("<div><div><b><p>Damage</p></b></div><div style='color:rgba(230,0,0,1)'><p>%s %s</p></div></div>", $aJobRow['JOB_OUT_DAMAGE'], $GLOBALS['CURRENCY_SYMBOL']);
			}

			if($bIsJobIncOutSameAccess)
			{
				$fJobSum = HTMLJobPITTransSum($InrConn, $InrLogHandle, $IniUserAccess, $iJobIndex);

				$fJobSum += (float) (((float) $aJobRow['JOB_INC_PIA']) + (-abs((float)$aJobRow['JOB_OUT_EXPENSES']) - abs((float)$aJobRow['JOB_OUT_DAMAGE'])));

				//Data Row
				print("<div><div><b><p>Sumary</p></b></div>");

				if($fJobSum < 0)
					print("<div style='color:rgba(230,0,0,1)'>");
				elseif($fJobSum > 0)
					print("<div style='color:rgba(0,230,0,1)'>");
				else
					print("<div style='color:rgba(230,230,0,1)'>");

				printf("<p>%1.2f %s</p></div></div>", $fJobSum, $GLOBALS['CURRENCY_SYMBOL']);
			}

			//Button list for specific Data Row
			printf("<div><input type='hidden' name='JobIndex' value='%d'>", $aJobRow['JOB_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Delete']);

			if(($bIsJobIncOutSameAccess))
				printf("<input id='JobPIT' type='submit' value='Payments' formaction='.?MenuIndex=%s&Module=3'>", $GLOBALS['MENU_INDEX']['Job']);

			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Edit']);

			print("</form></div>");
		}
	}
}


function HTMLJobPITTransSum(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess, int $IniJobIndex) : float
{
	$fPITSum =(float) 0;

	$rResult = JobPITByJobIDSpecificRetriever($InrConn, $InrLogHandle, $IniJobIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

	if(!empty($rResult) && ($rResult->num_rows == 1))
	{
		$aDataRow = $rResult->fetch_array(MYSQLI_ASSOC);

		$fPITSum = (float) $aDataRow['JOB_PIT_SUM'];

		$rResult->free();
	}
	else
		$InrLogHandle->AddLogMessage("Failed to retrieve data", __FILE__, __FUNCTION__, __LINE__);

	return round($fPITSum, $GLOBALS['CURRENCY_DECIMAL_PRECISION']);
}
?>
