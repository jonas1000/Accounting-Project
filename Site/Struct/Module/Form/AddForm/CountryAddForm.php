<?php
function HTMLCountryAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    //Title
    print("<div id='FormTitle'><h3>New Country</h3></div>");

    //Input Row - name
    print("<div><label>Name*<input type='text' placeholder='Country name' name='Name' required></label></div>");

    //get rows and render <select> element with data
    print("<div><label>Access");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div>");

    printf("<div><input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $GLOBALS['MENU_INDEX']['Country'], $GLOBALS['MODULE']['Add']);
    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Country']);

    print("</form></div>");
}
?>
