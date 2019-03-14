<?php
 //-------------<FUNCTION>-------------//
function HTMLCountyEditForm(ME_CDBConnManager &$InDBConn, &$IniUserAccessLevelIndex) : void
{
    if(isset($_POST['CouIndex']))
    {
        if(!empty($_POST['CouIndex']))
        {
            $iCountyIndex = (int) $_POST['CouIndex'];

            unset($_POST['CouIndex']);

            if($iCountyIndex > 0)
            {
                CountyGeneralSpecificRetriever($InDBConn, $iCountyIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                $aCountyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iCountyNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aCountyRow) && ($iCountyNumRows > 0) && ($iCountyNumRows < 2)) 
                {
                    $iCountyAccessIndex = (int) $aCountyRow['COU_DATA_ACCESS'];
                    $iCountryIndex = (int) $aCountyRow['COUN_ID'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");

                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>New County</h3>");
                    printf("<br><h4>%s</h4>", $aCountyRow['COU_DATA_TITLE']);
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Name</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' placeholder='County name' name='Name' value='%s' required>", $aCountyRow['COU_DATA_TITLE']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Tax</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='number' placeholder='County Tax' name='Tax' value='%s' step='0.01' min='0.00' max='100.00'>", $aCountyRow['COU_DATA_TAX']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Interest Rate</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='number' placeholder='County Interest Rate' name='IR' value='%s' step='0.01' min='0.00' max='100.00'>", $aCountyRow['COU_DATA_IR']);
                    print("</div>");
                    print("</div>");

                    //Input Row
                    print("<div>");
                    print("<div>");
                    print("<h5>Date</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='Date' placeholder='County modification date' name='Date' value='%s' required>", $aCountyRow['COU_DATA_DATE']);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Country</h5>");
                    print("</div>");

                    print("<div>");
                    RenderCountrySelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iCountryIndex);
                    print("</div>");
                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");
                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iCountyAccessIndex);
                    print("</div>");
                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='hidden' name='CountyIndex' value='%s' required>", $aCountyRow['COU_ID']);
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $_GET['MenuIndex'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%s'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['County']);
                    print("</div>");

                    print("</form>");

                    print("</div>");

                    unset($iCountryIndex, $iCountyAccessIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($aCountyRow, $iCountyNumRows);
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
 