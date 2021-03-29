<?php
//-------------<FUNCTION>-------------//
function HTMLShareholderAddForm(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
  	//-------------<PHP-HTML>-------------//
	print("<div class='Form'><form method='POST'><div>");

	//Title
	print("<div id='FormTitle'><h3>New Shareholder</h3></div>");

	//Input Row
	print("<div><label>Employee");
	RenderEmployeeSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
	print("</label></div>");

	//Input Row
	print("<div><label>Access");
	RenderAccessSelectRow($InrConn, $InrLogHandle, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);
	print("</label></div></div>");

	printf("<div><input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $GLOBALS['MENU_INDEX']['Shareholder'], $GLOBALS['MODULE']['Add']);
	printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a></div>", $GLOBALS['MENU_INDEX']['Shareholder']);

	print("</form></div>");
}
?>