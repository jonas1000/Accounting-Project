<?php
function HTMLJobAssigmentAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
    require_once("Struct/Element/Function/Select/DBSelectRender.php");

    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    //Title
    print("<div id='FormTitle'><h3>New Job Assigment</h3></div>");

    //Input Row - name
    print("<div><label>Name<input name='Name' type='text' placeholder='Job name' required></label></div>");

    //Input Row - price
    print("<div><label>Price<input name='Price' type='number' placeholder='Job price' required></label></div>");

    //Input Row - PIA
    print("<div><label>Payment in advance<input name='PIA' type='number' placeholder='Job Payment in advance'></label></div>");

    //Input Row - expenses
    print("<div><label>Expenses<input name='Expenses' type='number' placeholder='Job expensess'></label></div>");

    //Input Row - damage
    print("<div><label>Damage<input name='Damage' type='number' placeholder='Job Damage expensess'></label></div>");

    //Input Row - company list
    print("<div><label>Company");
    RenderCompanySelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div>");

    //Input Row - access list
    print("<div><label>Access");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div></div>");

    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&%d&ProAdd'></div>", $GLOBALS['MENU_INDEX']['JobAssigment'], $GLOBALS['MODULE']['Add']);
    printf("<div><a href='.?MenuIndex=%d'><div class='Button-Left'><h5>Cancel</h5></div></a>", $GLOBALS['MENU_INDEX']['JobAssigment']);

    print("</form></div>");
}
?>
