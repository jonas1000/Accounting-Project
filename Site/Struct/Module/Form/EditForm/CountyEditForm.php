<?php
 //-------------<FUNCTION>-------------//
function HTMLCountyEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, $IniUserAccess) : void
{
    if(isset($_POST['CouIndex']) && !empty($_POST['CouIndex']))
    {
        $iCountyIndex = (int) $_POST['CouIndex'];

        if($iCountyIndex > 0)
        {
            $rResult = CountyEditFormSpecificRetriever($InrConn, $InrLogHandle, $iCountyIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1)) 
            {
                $aDataRow = $rResult->fetch_assoc();

                //-------------<PHP-HTML>-------------//
                print("<div class='Form'><form method='POST'><div>");

                //Title
                printf("<div id='FormTitle'><h3>New County</h3><br><h4>%s</h4></div>", $aDataRow['COU_DATA_TITLE']);

                //Input Row - name
                printf("<div><label>Name*<input type='text' placeholder='County name' name='Name' value='%s' required></label></div>", $aDataRow['COU_DATA_TITLE']);

                //Input Row - tax
                printf("<div><label>Tax<input type='number' placeholder='County Tax' name='Tax' value='%s' step='0.01' min='0.00' max='100.00'></label></div>", $aDataRow['COU_DATA_TAX']);

                //Input Row - interest rate
                printf("<div><label>Interest Rate<input type='number' placeholder='County Interest Rate' name='IR' value='%s' step='0.01' min='0.00' max='100.00'></label></div>", $aDataRow['COU_DATA_IR']);

                //get rows and render <select> element with data
                print("<div><label>Country");
                RenderCountrySelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $aDataRow['COUN_ID']);
                print("</label></div>");

                //get rows and render <select> element with data
                print("<div><label>Access");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $aDataRow['COU_DATA_ACCESS']);
                print("</label></div></div>");

                printf("<div><input type='hidden' name='CountyIndex' value='%s' required>", $aDataRow['COU_ID']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProEdit'>", $GLOBALS['MENU_INDEX']['County'], $GLOBALS['MODULE']['Edit']);
                printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['County']);

                print("</form></div>");

                $rResult->free();
            }
            else
                $InrLogHandle->AddLogMessage("empty or too many rows returned, expected 1 result", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("ID expected to be greater than 0, instead value was lesser", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("ID was not set or returned empty", __FILE__, __FUNCTION__, __LINE__);
}
 