<?php
//-------------<FUNCTION>-------------//
function HTMLShareholderAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
  	//-------------<PHP-HTML>-------------//
	print("<div class='Form'>");
	print("<form method='POST'>");
	print("<div>");

	//Title
	print("<div id='FormTitle'>");
	print("<h3>New Shareholder</h3>");
	print("</div>");

	//Input Row
	print("<div>");
	print("<div>");
	print("<h5>Employee</h5>");
	print("</div>");

	print("<div>");
	RenderEmployeeSelectRow($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);
	print("</div>");
	print("</div>");

	//Input Row
	print("<div>");
	print("<div>");
	print("<h5>Access</ph5>");
	print("</div>");

	print("<div>");
	RenderAccessSelectRow($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);
	print("</div>");
	print("</div>");

	print("</div>");

	print("<div>");
	printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
	printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_GET['MenuIndex']);
	print("</div>");

	print("</form>");

	print("</div>");
}
?>