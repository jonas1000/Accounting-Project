<?php 
function HTMLCompanyEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    if(isset($_POST['CompIndex']) && !empty($_POST['CompIndex']))
    {
        $iCompanyIndex = (int) $_POST['CompIndex'];

        if($iCompanyIndex > 0)
        {
            $rResult = CompanyEditFormSpecificRetriever($InrConn, $InrLogHandle, $iCompanyIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                //-------------<PHP-HTML>-------------//
                print("<div class='Form'><form method='POST'><div>");

                //Title
                printf("<div id='FormTitle'><h3>Edit Company</h3><br><h4>%s</h4></div>", $aDataRow['COMP_DATA_TITLE']);

                //Input Row - name
                printf("<div><label>Name*<input name='Name' type='text' placeholder='Company Name' value='%s' required></label></div>", $aDataRow['COMP_DATA_TITLE']);

                //Input Row - creation date
                printf("<div><label>creation date*<input name='Date' type='date' value='%s' required></label></div>", $aDataRow['COMP_DATA_DATE']);

                //get rows and render <select> element with data
                print("<div><label>County");
                RenderCountySelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $aDataRow['COU_ID']);
                print("</label></div>");

                //get rows and render <select> element with data
                print("<div><label>Access Type");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $aDataRow['COMP_ACCESS']);
                print("</label></div></div>");

                //Input Buttons
                printf("<div><input type='hidden' name='CompIndex' value='%s' required>", $aDataRow['COMP_ID']);
                printf("<a href='.?MenuIndex=%s'><div><p>Cancel</p></div></a>", $GLOBALS['MENU_INDEX']['Company']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'></div>", $GLOBALS['MENU_INDEX']['Company'], $_GET['Module']);

                print("</form></div>");

                $rResult->free();
            }
            else
                $InrLogHandle->AddLogMessage("empty or too many rows returned, expected single result", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("ID expected to be greater than 0, instead value was lesser", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("ID was not set or returned empty", __FILE__, __FUNCTION__, __LINE__);
}
?>