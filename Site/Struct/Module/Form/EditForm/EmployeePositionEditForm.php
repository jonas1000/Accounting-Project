<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeePositionEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    if(isset($_POST['EmpPosIndex']) && !empty($_POST['EmpPosIndex']))
    {
        $iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];

        if($iEmployeePositionIndex > 0)
        {
            $rResult = EmployeePositionSpecificRetriever($InrConn, $InrLogHandle, $iEmployeePositionIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                //-------------<PHP-HTML>-------------//
                print("<div class='Form'><form method='POST'><div>");

                //Title
                printf("<div id='FormTitle'><h3>Edit Employee Position</h3><br><h4>%s</h4></div>", $aDataRow['EMP_POS_TITLE']);

                //Input Row
                printf("<div><label>Title*<input type='text' name='Name' placeholder='title position' value='%s' required></label></div>", $aDataRow['EMP_POS_TITLE']);

                //get rows and render <select> element with data
                print("<div><label>Access");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $aDataRow['EMP_POS_ACCESS']);
                print("</label></div></div>");

                //Button Input
                printf("<div><input type='hidden' value='%s' name='EmpPosIndex'>", $aDataRow['EMP_POS_ID']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $GLOBALS['MENU_INDEX']['EmployeePosition'], $GLOBALS['MODULE']['Edit']);
                printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['EmployeePosition']);

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