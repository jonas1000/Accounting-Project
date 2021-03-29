<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");
require_once("Output/Retriever/CountryRetriever.php");

function HTMLCountryOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    $sSearchQuery = (isset($_GET['SearchQuery'])) ? htmlspecialchars($_GET['SearchQuery']) : "";
    $sSearchType = (isset($_GET['SearchType'])) ? htmlspecialchars($_GET['SearchType']) : "";

    $rCounListResult = 0;

    if(!$rCounListResult = CountryOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $sSearchType, $sSearchQuery))
        $InrLogHandle->AddLogMessage("Failed to get result from Company Retriever" , __FILE__, __FUNCTION__, __LINE__);
    else
    {		
        HTMLCountryOverviewDataBlock($rCounListResult, $InrLogHandle, $IniUserAccess);

        $rCounListResult->free();
    }
}

function HTMLCountryOverviewDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    $sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['COUNTRY_SEARCH_TYPE'], $sSearchTypeSelected);

    //The toolbar for the buttons (tools)
    printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['Country'], $GLOBALS['MODULE']['Add']);
    printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['Country'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

    foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
    {
        if(((int) $aDataRow['COUN_DATA_ACCESS']) >= $IniUserAccess)
        {
            print("<div class='DataBlock'><form method='POST'>");

            //Data Row - country title
            printf("<div><div><h5>%s</h5></div></div>", $aDataRow['COUN_DATA_TITLE']);

            //Button list for specific Data Row
            printf("<div><input type='hidden' name='CounIndex' value='%d'>", $aDataRow['COUN_ID']);
            printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['Country'], $GLOBALS['MODULE']['Delete']);
            printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['Country'], $GLOBALS['MODULE']['Edit']);

            print("</form></div>");
        }
        else
            $InrLogHandle->AddLogMessage("Access was denied, not enought privilege to retrieve data from query", __FILE__, __FUNCTION__, __LINE__);
    }
}
?>
