<?php
//-------------<FUNCTION>-------------//
function HTMLJobEditForm(ME_CDBConnManager &$InDBConn, &$IniUserAccessLevelIndex) : void
{
    if(isset($_POST['JobIndex']))
    {
        if(!empty($_POST['JobIndex']))
        {
            $iJobIndex = (int) $_POST['JobIndex'];

            unset($_POST['JobIndex']);

            if($iJobIndex > 0)
            {
                JobGeneralSpecificRetriever($InDBConn, $iJobIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                $aJobRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iJobNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aJobRow) && ($iJobNumRows > 0 && $iJobNumRows < 2))
                {
                    $iCompIndex = (int) $aJobRow['COMP_ID'];
                    $iJobAccessIndex = (int) $aJobRow['JOB_ACCESS'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");
                    print("<form method='POST'>");
                    print("<div>");

                    print("<div id='FormTitle'>");
                    print("<h3>Edit Job</h3>");
                    printf("<h4>%s</h4>", $aJobRow['JOB_DATA_TITLE']);
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Name</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Name' type='text' placeholder='Job name' value='%s' required>", $aJobRow['JOB_DATA_TITLE']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Price</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Price' step='0.01' min='0.0' type='number' placeholder='Job price' value='%s'>", $aJobRow['JOB_INC_PRICE']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Payment in advance</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='PIA' type='number' step='0.01' min='0.0' placeholder='Job Payment in advance' value='%s'>", $aJobRow['JOB_INC_PIA']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Expenses</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Expenses' type='number' step='0.01' min='0.0' placeholder='Job expensess' value='%s'>", $aJobRow['JOB_OUT_EXP']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Damage</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Damage' type='number' step='0.01' min='0.0' placeholder='Job Damage expensess' value='%s'>", $aJobRow['JOB_OUT_DAM']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Date</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Date' type='Date' value='%s' required>", $aJobRow['JOB_DATA_DATE']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Company</h5>");
                    print("</div>");

                    print("<div>");
                    RenderCompanySelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iCompIndex);
                    print("</div>");
                    print("</div>");

                    print("<div>");
                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iJobAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='hidden' name='JobIndex' value='%s' required>", $aJobRow['JOB_ID']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Job']);
                    print("</div>");

                    print("</form>");
                    print("</div>");

                    unset($iJobAccessIndex, $iCompIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($aJobRow, $iJobIndex, $iJobNumRows);
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