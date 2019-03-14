<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeeEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
    if(isset($_POST['EmpIndex']))
    {
        if(!empty($_POST['EmpIndex']))
        {
            $iEmployeeIndex = (int) $_POST['EmpIndex'];

            unset($_POST['EmpIndex']);
            
            if($iEmployeeIndex > 0)
            {
                EmployeeGeneralSpecificRetriever($InDBConn, $iEmployeeIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                $aEmployeeRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iEmployeeNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aEmployeeRow) && ($iEmployeeNumRows > 0) && ($iEmployeeNumRows < 2))
                {
                    $iEmployeeAccessIndex = (int) $aEmployeeRow['EMP_ACCESS'];
                    $iCompanyIndex = (int) $aEmployeeRow['COMP_ID'];
                    $iEmployeePositionIndex = (int) $aEmployeeRow['EMP_POS_ID'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");
                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Employee</h3>");
                    printf("<br><h4>%s %s</h4>", $aEmployeeRow['EMP_DATA_NAME'], $aEmployeeRow['EMP_DATA_SURNAME']);
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Name</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' name='Name' placeholder='Employee Name' value='%s' required>", $aEmployeeRow['EMP_DATA_NAME']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Surname</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' name='Surname' placeholder='Employee Surname' value='%s' required>", $aEmployeeRow['EMP_DATA_SURNAME']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Email</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='email' name='Email' placeholder='Employee Email' value='%s' required>", $aEmployeeRow['EMP_DATA_EMAIL']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Salary</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='number' name='Salary' min='0.00' step='0.01' value='%s' placeholder='Employee Salary'>", $aEmployeeRow['EMP_DATA_SALARY']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Birth Date</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='date' name='BDay' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' value='%s' required>", $aEmployeeRow['EMP_DATA_BDAY']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Phone Number</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='tel' max='16' name='PN' value='%s' required>", $aEmployeeRow['EMP_DATA_PN']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Stable Number</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='tel' max='16' name='SN' value='%s'>", $aEmployeeRow['EMP_DATA_SN']);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Company</h5>");
                    print("</div>");

                    print("<div>");
                    RenderCompanySelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iCompanyIndex);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Position</h5>");
                    print("</div>");

                    print("<div>");
                    RenderEmployeePosSelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iEmployeePositionIndex);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iEmployeeAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='hidden' name='EmployeeIndex' value='%s'>", $aEmployeeRow['EMP_ID']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $_GET['MenuIndex'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Employee']);
                    print("</div>");

                    print("</div>");
                    print("</form>");

                    unset($iEmployeeAccessIndex, $iEmployeePositionIndex, $iCompanyIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($iEmployeeIndex, $aEmployeeRow, $iEmployeeNumRows);
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