<?php
 //-------------<FUNCTION>-------------//
function HTMLCustomerEditForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
    if(isset($_POST['CustIndex']) && !empty($_POST['CustIndex']))
    {
        $iCustomerIndex = (int) $_POST['CustIndex'];

        if($iCustomerIndex > 0)
        {
            $rResult = CustomerGeneralSpecificRetriever($InrConn, $InrLogHandle, $iCustomerIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1)) 
            {
                $aDataRow = $rResult->fetch_assoc();

                //-------------<PHP-HTML>-------------//
                print("<div class='Form'><form method='POST'><div>");

                //Title
                printf("<div id='FormTitle'><h3>Edit Customer</h3><br><h4>%s</h4></div>", $aDataRow['CUST_DATA_NAME']);

                //Input Row - name
                printf("<div><label>Name*<input type='text' maxlength='64' placeholder='Name' name='Name' value='%s' required></label></div>", $aDataRow['CUST_DATA_NAME']);

                //Input Row - surname
                printf("<div><label>Surname*<input type='text' maxlength='64' placeholder='Surname' name='Surname' value='%s' required></label></div>", $aDataRow['CUST_DATA_SURNAME']);

                //Input Row - phone number
                printf("<div><label>Phone number*<input type='tel' maxlength='16' placeholder='cell phone' name='PhoneNumber' value='%s' required></label></div>", $aDataRow['CUST_DATA_PN']);

                //Input Row - stable number
                printf("<div><label>Stable number<input type='tel' maxlength='16' placeholder='Stable number(house or bussiness)' name='StableNumber' value='%s'></label></div>", $aDataRow['CUST_DATA_SN']);

                //Input Row - email
                printf("<div><label>Email<input type='email' maxlength='64' placeholder='customer@email.com' name='Email' value='%s'></label></div>", $aDataRow['CUST_DATA_EMAIL']);

                //Input Row - VAT
                printf("<div><label>VAT<input type='text' maxlength='32' placeholder='GR123456789' name='VAT' value='%s'></label></div>", $aDataRow['CUST_DATA_VAT']);

                //Input Row - address
                printf("<div><label>Address<textarea placeholder='Description' spellcheck='true' rows='5' cols='10' maxlegnth='128' name='Addr' value='%s'></textarea></label></div>", $aDataRow['CUST_DATA_ADDR']);

                //Input Row
                printf("<div><label>Note<textarea placeholder='Note' spellcheck='true' rows='5' 'cols='10' maxlegnth='256' name='Note' value='%s'></textarea></label></div>", $aDataRow['CUST_DATA_NOTE']);

                //get rows and render <select> element with data
                print("<div><label>Access");
                RenderAccessSelectRowCheck($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show'], $aDataRow['CUST_DATA_ACCESS']);
                print("</label></div></div>");

                printf("<div><input type='hidden' value='%s' name='CustIndex'>", $aDataRow['CUST_ID']);
                printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProEdit'>", $GLOBALS['MENU_INDEX']['Customer'], $GLOBALS['MODULE']['Edit']);
                printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Customer']);

                print("</form></div>");

                $rResult->free();
            }
            else
                $InrLogHandle->AddLogMessage("empty or too many rows returned, expected 1 result", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("ID expected to be greater than 0, instead value was lesser", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("ID was not set or returned empty", __FILE__, __FUNCTION__, __LINE__);
}
 