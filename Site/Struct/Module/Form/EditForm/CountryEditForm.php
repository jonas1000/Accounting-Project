<?php
 //-------------<FUNCTION>-------------//
function HTMLCountryEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
    if(isset($_POST['CounIndex']))
    {
        if(!empty($_POST['CounIndex']))
        {
            $iCountryIndex = (int) $_POST['CounIndex'];

            unset($_POST['CounIndex']);

            if($iCountryIndex > 0)
            {
                CountryEditFormSpecificRetriever($InDBConn, $iCountryIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                $aCountryData = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iCountryNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aCountryData) && ($iCountryNumRows > 0 && $iCountryNumRows < 2))
                {
                    $iCountryAccessIndex = (int) $aCountryData['COUN_ACCESS'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");

                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Country</h3>");
                    printf("<br><h4>%s</h4>", $aCountryData['COUN_DATA_TITLE']);
                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Name*</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' placeholder='Country name' name='Name' value='%s' required>", $aCountryData['COUN_DATA_TITLE']);
                    print("</div>");

                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");

                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show'], $iCountryAccessIndex);
                    print("</div>");

                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='hidden' name='CounIndex' value='%s' required>", $aCountryData['COUN_ID']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $_GET['MenuIndex'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%s'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Country']);
                    print("</div>");
                    print("</form>");

                    print("</div>");

                    unset($iCountryAccessIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($aCountryData, $iCountryIndex, $iCountryNumRows);
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