<?php
require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
require_once("../MedaLib/Function/Generator/HTMLSelectStructure.php");
require_once("Output/Retriever/CompanyRetriever.php");

function HTMLCompanyOverview(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    $sSearchQuery = (isset($_GET['SearchQuery'])) ? htmlspecialchars($_GET['SearchQuery']) : "";
    $sSearchType = (isset($_GET['SearchType'])) ? htmlspecialchars($_GET['SearchType']) : "";

    //The variable object that holds the query result
    $rResult = 0;

    if(!$rResult = CompanyOverviewRetriever($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $sSearchType, $sSearchQuery))
        $InrLogHandle->AddLogMessage("Failed to get result from Company Retriever" , __FILE__, __FUNCTION__, __LINE__);
    else
    {
        HTMLCompanyDataBlock($rResult, $InrLogHandle, $IniUserAccess);

        $rResult->free();
    }
}


function HTMLCompanyDataBlock(mysqli_result &$InrResult, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{

    $sSearchSelectStructName = "SearchType";
    $sHTMLGeneratedSelectStructure = "";
    $sSearchTypeSelected = isset($_GET[$sSearchSelectStructName]) ? $_GET[$sSearchSelectStructName] : "";

    HTMLGenerateSelectStructure($sHTMLGeneratedSelectStructure, $sSearchSelectStructName, $GLOBALS['COMPANY_SEARCH_TYPE'], $sSearchTypeSelected);

    //The toolbar for the buttons (tools)
    printf("<div class='ContentToolBar'><a href='.?MenuIndex=%d&Module=%d'><div class='Button-Left'><h5>ADD</h5></div></a>", $GLOBALS['MENU_INDEX']['Company'], $GLOBALS['MODULE']['Add']);
    printf("<form action='.' method='get'><input type='hidden' name='MenuIndex' value='%d'><label>Search by%s</label><label>Query <input type='text' name='SearchQuery' value='%s'></label><button>submit</button></form></div>", $GLOBALS['MENU_INDEX']['Company'], $sHTMLGeneratedSelectStructure, (isset($_GET['SearchQuery'])) ? $_GET['SearchQuery'] : "");

    foreach($InrResult->fetch_all(MYSQLI_ASSOC) as $aDataRow)
    {
        if(((int) $aDataRow['COMP_DATA_ACCESS']) >= $IniUserAccess)
        {
            print("<div class='DataBlock'><form method='POST'>");
            
            //Data Row - company title
            printf("<div><h5>%s</h5></div>", $aDataRow['COMP_DATA_TITLE']);

            //Data Row - company creation date
            printf("<div><div><b><p>Creation Date</p></b></div><div><p>%s</p></div></div>", $aDataRow['COMP_DATA_DATE']);

            //Data Row - country title
            if((((int) $aDataRow['COUN_DATA_ACCESS']) >= $IniUserAccess))
                printf("<div><div><b><p>Country</p></b></div><div><p>%s</p></div></div>", $aDataRow['COUN_DATA_TITLE']);

            if(((int) $aDataRow['COU_DATA_ACCESS']) >= $IniUserAccess)
            {
                //Data Row - county name
                printf("<div><div><b><p>County</p></b></div><div><p>%s</p></div></div>", $aDataRow['COU_DATA_TITLE']);

                //Data Row - county tax
                printf("<div><div><b><p>Tax</p></b></div><div><p>%s</p></div></div>", $aDataRow['COU_DATA_TAX']);

                //Data Row - county interest rate
                printf("<div><div><b><p>Interest Rate</p></b></div><div><p>%s</p></div></div>", $aDataRow['COU_DATA_IR']);
            }

            //Button list for specific Data Row
            printf("<div><input type='hidden' name='CompIndex' value='%d'>", $aDataRow['COMP_ID']);
            printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%d&Module=%d'>", $GLOBALS['MENU_INDEX']['Company'], $GLOBALS['MODULE']['Delete']);
            printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%d&Module=%d'></div>", $GLOBALS['MENU_INDEX']['Company'], $GLOBALS['MODULE']['Edit']);

            print("</form></div>");
        }
        else
            $InrLogHandle->AddLogMessage("Access was denied, not enought privilege to retrieve data from query", __FILE__, __FUNCTION__, __LINE__);
    }
}
?>