<?php
//-------------<FUNCTION>-------------//
function HTMLJobPITEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
    if(isset($_POST['JobPITIndex']))
    {
        if(!empty($_POST['JobPITIndex']))
        {
            $iJobPITIndex = (int) $_POST['JobPITIndex'];

            unset($_POST['JobPITIndex']);

            if($iJobPITIndex > 0)
            {
                JobPITSpecificRetriever($InDBConn, $iJobPITIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                $aJobPITRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iJobPITNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aJobPITRow) && ($iJobPITNumRows > 0 && $iJobPITNumRows < 2))
                {
                    $iJobPITAccessIndex = (int) $aJobPITRow['JOB_PIT_ACCESS'];

                    print("<div class='Form'>");

                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Payment</h3>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Payment</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='number' name='PIT' value='%s'>", $aJobPITRow['JOB_PIT_PAYMENT']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Date*</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='date' name='Date' value='%s' required>", $aJobPITRow['JOB_PIT_DATE']);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show'], $iJobPITAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='hidden' name='JobPITIndex' value='%d'>", $aJobPITRow['JOB_PIT_ID']);
                    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Job']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&SubModule=%d&ProEdit'>", $_GET['MenuIndex'], $_GET['Module'], $_GET['SubModule']);
                    print("</div>");
                    print("</form>");

                    print("</div>");

                    unset($iJobPITAccessIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($aJobPITRow, $iJobPITIndex, $iJobPITNumRows);
            }
            else
                throw new Exception("POST data could not be converted to required format");
        }
        else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>