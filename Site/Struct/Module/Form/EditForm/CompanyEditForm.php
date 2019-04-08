<?php 
function HTMLCompanyEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
    if(isset($_POST['CompIndex']))
    {
        if(!empty($_POST['CompIndex']))
        {
            $iCompanyIndex = (int) $_POST['CompIndex'];

            unset($_POST['CompIndex']);

            if($iCompanyIndex > 0)
            {
                CompanyEditFormSpecificRetriever($InDBConn, $iCompanyIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                $aCompanyData = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iCompanyNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aCompanyData) && ($iCompanyNumRows > 0 && $iCompanyNumRows < 2))
                {
                    $iCountyIndex = (int) $aCompanyData['COU_ID'];
                    $iCompanyAccessIndex = (int) $aCompanyData['COMP_ACCESS'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");

                    print("<form method='POST'>");

                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Company</h3>");
                    printf("<br><h4>%s</h4>", $aCompanyData['COMP_DATA_TITLE']);
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Name*</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Name' type='text' placeholder='Company Name' value='%s' required>", $aCompanyData['COMP_DATA_TITLE']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>creation date*</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input name='Date' type='date' value='%s' required>", $aCompanyData['COMP_DATA_DATE']);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>County</h5>");
                    print("</div>");

                    print("<div>");
                    RenderCountySelectRowCheck($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show'], $iCountyIndex);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Access Type</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show'], $iCompanyAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    //Input Buttons
                    print("<div>");
                    printf("<input type='hidden' name='CompIndex' value='%s' required>", $aCompanyData['COMP_ID']);
                    printf("<a href='.?MenuIndex=%s'><div><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Company']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $_GET['MenuIndex'], $_GET['Module']);
                    print("</div>");

                    print("</form>");

                    print("</div>");

                    unset($iCountyIndex, $iCompanyAccessIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($iCompanyIndex, $aCompanyData, $iCompanyNumRows);
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