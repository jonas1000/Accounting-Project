<?php
function HTMLCompanyAddForm(ME_CDBConnManager &$InrConn,ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    //Title
    print("<div id='FormTitle'><h3>New Company</h3></div>");

    //Input Row - name
    print("<div><label>Name*<input name='Name' type='text' placeholder='Company Name' required></label></div>");

    //Input Row - creation date
    print("<div><label>creation date*<input name='Date' type='date' required></label></div>");

    //get rows and render <select> element with data
    print("<div><label>County");
    RenderCountySelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div>");

    //get rows and render <select> element with data
    print("<div><label>Access Type");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div>");

    //Input Buttons
    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'></div>", $GLOBALS['MENU_INDEX']['Company'], $GLOBALS['MODULE']['Add']);
    printf("<div><a href='.?MenuIndex=%d'><div><p>Cancel</p></div></a>", $GLOBALS['MENU_INDEX']['Company']);

    print("</form></div>");
}
?>