<?php
function HTMLJobAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    print("<div id='FormTitle'><h3>New Job</h3></div>");

    //Input Row - name
    print("<div><label>Name*<input name='Name' type='text' placeholder='Job name' required></label></div>");

    //Input Row - price
    print("<div><label>Price<input name='Price' step='0.01' min='0.0' type='number' placeholder='Job price'></label></div>");

    //Input Row - payment in advance (PIA)
    print("<div><label>Payment in advance<input name='PIA' type='number' step='0.01' min='0.0' placeholder='Job Payment in advance'></label></div>");

    //Input Row - expenses
    print("<div><label>Expenses<input name='Expenses' type='number' step='-0.01' min='0.0' placeholder='Job expensess'></label></div>");

    //Input Row - damage
    print("<div><label>Damage<input name='Damage' type='number' step='-0.01' min='0.0' placeholder='Job Damage expensess'></label></div>");

    //Input Row - job date
    print("<div><label>Date*<input name='Date' type='Date' required></label></div>");

    //Input Row - company list
    print("<div><label>Company");
    RenderCompanySelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div>");

    //Input Row - access list
    print("<div><label>Access");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div></div>");

    printf("<div><input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Add']);
    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Job']);

    print("</form></div>");
}
?>
