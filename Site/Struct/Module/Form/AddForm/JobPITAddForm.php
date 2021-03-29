<?php
//-------------<FUNCTION>-------------//
function HTMLJobPITAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
  if(isset($_POST['JobIndex']) && !empty($_POST['JobIndex']))
  {
    $iJobIndex = (int) $_POST['JobIndex'];

    //-------------<PHP-HTML>-------------//
    print("<div class='Form'><form method='POST'><div>");

    //Title
    print("<div id='FormTitle'><h3>New Payment</h3></div>");

    //Input Row - payment
    print("<div><label>Payment<input type='number' name='PIT'></label></div>");

    //Input Row - date
    print("<div><label>Date*<input type='date' name='Date' required></label></div>");

    //Input Row - access list
    print("<div><label>Access");
    RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
    print("</label></div></div>");

    printf("<div><input type='hidden' name='JobIndex' value='%d'>", $iJobIndex);
    printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&SubModule=%d&ProAdd'>", $GLOBALS['MENU_INDEX']['Job'], $GLOBALS['MODULE']['Extend'], $GLOBALS['MODULE']['Add']);
    printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Job']);

    print("</form></div>");
  }
}
?>