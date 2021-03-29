<?php
function HTMLCountyAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    //Title
    print("<div id='FormTitle'><h3>New County</h3></div>");

    //Input Row
    print("<div><label>Name*<input type='text' placeholder='County name' name='Name' required></label></div>");

    //Input Row
    print("<div><label>Tax<input type='number' placeholder='County Tax' name='Tax' step='0.01' min='0.00' max='100.00'></label></div>");

    //Input Row
    print("<div><label>Interest Rate<input type='number' placeholder='County Interest Rate' name='IR' step='0.01' min='0.00' max='100.00'></label></div>");

    //get rows and render <select> element with data
    print("<div><label>Country");
    RenderCountrySelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div>");

    //get rows and render <select> element with data
    print("<div><label>Access");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div></div>");

    printf("<div><input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $GLOBALS['MENU_INDEX']['County'], $GLOBALS['MODULE']['Add']);
    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['County']);

    print("</form></div>");
}
?>
