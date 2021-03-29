<?php
//-------------<FUNCTION>-------------//
function HTMLJobEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    if(isset($_POST['JobIndex']) && !empty($_POST['JobIndex']))
    {
        $iJobIndex = (int) $_POST['JobIndex'];

        if($iJobIndex > 0)
        {
            $rResult = JobGeneralSpecificRetriever($InrConn, $InrLogHandle, $iJobIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                //-------------<PHP-HTML>-------------//
                print("<div class='Form'><form method='POST'><div>");

                printf("<div id='FormTitle'><h3>Edit Job</h3><h4>%s</h4></div>", $aDataRow['JOB_DATA_TITLE']);

                //Input Row - name
                printf("<div><label>Name*<input name='Name' type='text' placeholder='Job name' value='%s' required></label></div>", $aDataRow['JOB_DATA_TITLE']);

                //Input Row - price
                printf("<div><label>Price<input name='Price' step='0.01' min='0.0' type='number' placeholder='Job price' value='%s'></label></div>", $aDataRow['JOB_INC_PRICE']);

                //Input Row - payment in advance (PIA)
                printf("<div><label>Payment in advance<input name='PIA' type='number' step='0.01' min='0.0' placeholder='Job Payment in advance' value='%s'></label></div>", $aDataRow['JOB_INC_PIA']);

                //Input Row - expenses
                printf("<div><label>Expenses<input name='Expenses' type='number' step='0.01' min='0.0' placeholder='Job expensess' value='%s'></label></div>", abs($aDataRow['JOB_OUT_EXPENSES']));

                //Input Row - damage
                printf("<div><label>Damage<input name='Damage' type='number' step='0.01' min='0.0' placeholder='Job Damage expensess' value='%s'></label></div>", abs($aDataRow['JOB_OUT_DAMAGE']));

                //Input Row - date
                printf("<div><label>Date*<input name='Date' type='Date' value='%s' required></label></div>", $aDataRow['JOB_DATA_DATE']);

                //Input Row - company list
                print("<div><label>Company");
                RenderCompanySelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], (int) $aDataRow['COMP_ID']);
                print("</label></div>");

                //Input Row - access list
                print("<div><label>Access");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], (int) $aDataRow['JOB_ACCESS']);
                print("</label></div></div>");

                printf("<div><input type='hidden' name='JobIndex' value='%s' required>", $aDataRow['JOB_ID']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProEdit'>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Edit']);
                printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Job']);

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