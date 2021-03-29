<?php
//-------------<FUNCTION>-------------//
function HTMLShareholderEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    if(isset($_POST['ShareIndex']) && !empty($_POST['ShareIndex']))
    {
        $iShareholderIndex = (int) $_POST['ShareIndex'];

        if($iShareholderIndex > 0)
        {
            $rResult = ShareholderSpecificRetriever($InrConn, $InrLogHandle, $iShareholderIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                print("<div class='Form'><form method='POST'><div>");

                //Title
                print("<div id='FormTitle'><h3>Edit Shareholder</h3></div>");

                //Input Row - employee list
                print("<div><label>Employee");
                RenderEmployeeSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], (int) $aDataRow['EMP_ID']);
                print("</label></div>");

                //Input Row - access list
                print("<div><label>Access");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], (int) $aDataRow['SHARE_ACCESS']);
                print("</label></div></div>");

                printf("<div><input type='hidden' value='%s' name='ShareIndex' required>", $aDataRow['SHARE_ID']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProEdit'>", $GLOBALS['MENU_INDEX']['Shareholder'], $GLOBALS['MODULE']['Edit']);
                printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Shareholfer']);

                print("</form></div>");

                $rResult->free();
            }
            else
                $InrLogHandle->AddLogMessage("Query did not return any row", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("POST data could not be converted to required format", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("Some POST data are not initialized", __FILE__, __FUNCTION__, __LINE__);
}
?>