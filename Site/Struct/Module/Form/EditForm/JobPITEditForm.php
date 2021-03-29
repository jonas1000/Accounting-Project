<?php
//-------------<FUNCTION>-------------//
function HTMLJobPITEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    if(isset($_POST['JobPITIndex']) && !empty($_POST['JobPITIndex']))
    {
        $iJobPITIndex = (int) $_POST['JobPITIndex'];

        if($iJobPITIndex > 0)
        {
            $rResult = JobPITSpecificRetriever($InrConn, $InrLogHandle, $iJobPITIndex, $IniUserAccess, $_ENV['Available']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                print("<div class='Form'><form method='POST'><div>");

                //Title
                print("<div id='FormTitle'><h3>Edit Payment</h3></div>");

                //Input Row - payment
                printf("<div><label>Payment<input type='number' name='PIT' value='%s'></label></div>", $aDataRow['JOB_PIT_PAYMENT']);

                //Input Row - date
                printf("<div><label>Date*<input type='date' name='Date' value='%s' required></label></div>", $aDataRow['JOB_PIT_DATE']);

                //Input Row - access list
                print("<div><label>Access");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $_ENV['Available']['Show'], (int) $aDataRow['JOB_PIT_ACCESS']);
                print("</label></div></div>");

                printf("<div><input type='hidden' name='JobPITIndex' value='%d'>", $aDataRow['JOB_PIT_ID']);
                printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Job']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&SubModule=%d&ProEdit'></div>", $_ENV['MenuIndex']['Job'], $_ENV['Module']['Extend'], $_ENV['SubModule']['Edit']);

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