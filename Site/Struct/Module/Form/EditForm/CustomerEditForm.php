<?php
 //-------------<FUNCTION>-------------//
function HTMLCustomerEditForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
    if(isset($_POST['CustIndex']))
    {
        if(!empty($_POST['CustIndex']))
        {
            $iCustomerIndex = (int) $_POST['CustIndex'];

            unset($_POST['CustIndex']);

            if($iCustomerIndex > 0)
            {
                CustomerGeneralSpecificRetriever($InDBConn, $iCustomerIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                $aCustomerRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                $iCustomerNumRows = $InDBConn->GetResultNumRows();

                if(!empty($aCustomerRow) && ($iCustomerNumRows > 0) && ($iCustomerNumRows < 2)) 
                {
                    $iCustomerAccessIndex = $aCustomerRow['CUST_DATA_ACCESS'];

                    //-------------<PHP-HTML>-------------//
                    print("<div class='Form'>");

                    print("<form method='POST'>");
                    print("<div>");

                    //Title
                    print("<div id='FormTitle'>");
                    print("<h3>Edit Customer</h3>");
                    printf("<br><h4>%s</h4>", $aCustomerRow['CUST_DATA_NAME']);
                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Name</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' maxlength='64' placeholder='Name' name='Name' value='%s' required>", $aCustomerRow['CUST_DATA_NAME']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Surname</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' maxlength='64' placeholder='Surname' name='Surname' value='%s' required>", $aCustomerRow['CUST_DATA_SURNAME']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Phone number</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='tel' maxlength='16' placeholder='cell phone' name='PhoneNumber' value='%s' required>", $aCustomerRow['CUST_DATA_PN']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Stable number</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='tel' maxlength='16' placeholder='Stable number(house or bussiness)' name='StableNumber' value='%s'>", $aCustomerRow['CUST_DATA_SN']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Email</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='email' maxlength='64' placeholder='customer@email.com' name='Email' value='%s'>", $aCustomerRow['CUST_DATA_EMAIL']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>VAT</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<input type='text' maxlength='32' placeholder='GR123456789' name='VAT' value='%s'>", $aCustomerRow['CUST_DATA_VAT']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Address</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<textarea placeholder='Description' spellcheck='true' rows='5' cols='10' maxlegnth='128' name='Addr' value='%s'></textarea>", $aCustomerRow['CUST_DATA_ADDR']);
                    print("</div>");

                    print("</div>");

                    //Input Row
                    print("<div>");

                    print("<div>");
                    print("<h5>Note</h5>");
                    print("</div>");

                    print("<div>");
                    printf("<textarea placeholder='Note' spellcheck='true' rows='5' 'cols='10' maxlegnth='256' name='Note' value='%s'></textarea>", $aCustomerRow['CUST_DATA_NOTE']);
                    print("</div>");

                    print("</div>");

                    //get rows and render <select> element with data
                    print("<div>");

                    print("<div>");
                    print("<h5>Access</h5>");
                    print("</div>");

                    print("<div>");
                    RenderAccessSelectRowCheck($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show'], $iCustomerAccessIndex);
                    print("</div>");

                    print("</div>");

                    print("</div>");

                    print("<div>");
                    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%s&Module=%s&ProEdit'>", $_GET['MenuIndex'], $_GET['Module']);
                    printf("<a href='.?MenuIndex=%s'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Customer']);
                    print("</div>");
                    print("</form>");

                    print("</div>");

                    unset($iCustomerAccessIndex);
                }
                else
                    throw new Exception("Query did not return any row");

                unset($iCustomerIndex, $aCustomerRow, $iCustomerNumRows);
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
 