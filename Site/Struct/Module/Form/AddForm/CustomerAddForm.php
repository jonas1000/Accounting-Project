<?php
function HTMLCustomerAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    //Title
    print("<div id='FormTitle'><h3>New Customer</h3></div>");

    //Input Row - name
    print("<div><label>Name*<input type='text' maxlength='64' placeholder='Name' name='Name' required></label></div>");

    //Input Row - surname
    print("<div><label>Surname*<input type='text' maxlength='64' placeholder='Surname' name='Surname' required></label></div>");

    //Input Row - phone number
    print("<div><label>Phone number*<input type='tel' maxlength='16' placeholder='cell phone' name='PhoneNumber' required></label></div>");

    //Input Row - stable number
    print("<div><label>Stable number<input type='tel' maxlength='16' placeholder='Stable number(house or bussiness)' name='StableNumber'></label></div>");

    //Input Row - email
    print("<div><label>Email<input type='email' maxlength='64' placeholder='customer@email.com' name='Email'></label></div>");

    //Input Row - VAT
    print("<div><label>VAT<input type='text' maxlength='32' placeholder='GR123456789' name='VAT'></label></div>");

    //Input Row - Address
    print("<div><label>Address<textarea placeholder='Description' spellcheck='true' rows='5' cols='10' maxlegnth='128' name='Addr'></textarea></label></div>");

    //Input Row - Note
    print("<div><label>Note<textarea placeholder='Note' spellcheck='true' rows='5' 'cols='10' maxlegnth='256' name='Note'></textarea></label></div>");

    //get rows and render <select> element with data
    print("<div><label>Access");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div></div>");

    printf("<div><input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $GLOBALS['MENU_INDEX']['Customer'], $GLOBALS['MODULE']['Add']);
    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Customer']);

    print("</form></div>");
}
?>
