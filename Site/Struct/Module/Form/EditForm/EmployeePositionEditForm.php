<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeePositionEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
    if(isset($_POST['EmpPosIndex']))
    {
        if(!empty($_POST['EmpPosIndex']))
        {
            $iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];

            unset($_POST['EmpPosIndex']);

            if($iEmployeePositionIndex > 0)
            {
                EmployeePositionSpecificRetriever($InDBConn, $iEmployeePositionIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                $aEmployeePositionRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iEmployeePositionNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aEmployeePositionRow) && ($iEmployeePositionNumRows > 0 && $iEmployeePositionNumRows < 2))
                {
                    $iEmployeePositionAccessIndex = (int) $aEmployeePositionRow['EMP_POS_ACCESS'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");
                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Employee Position</h3>");
                    printf("<br><h4>%s</h4>", $aEmployeePositionRow['EMP_POS_TITLE']);
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Title*</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' name='Name' placeholder='title position' value='%s' required>", $aEmployeePositionRow['EMP_POS_TITLE']);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show'], $iEmployeePositionAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    //Button Input
                    print("<div>");
                    printf("<input type='hidden' value='%s' name='EmpPosIndex'>", $aEmployeePositionRow['EMP_POS_ID']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $_GET['MenuIndex'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['EmployeePosition']);
                    print("</div>");

                    print("</form>");
                    print("</div>");

                    unset($iEmployeePositionAccessIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($aEmployeePositionRow, $iEmployeePositionIndex, $iEmployeePositionNumRows);
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