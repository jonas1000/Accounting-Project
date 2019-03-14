<?php
//-------------<FUNCTION>-------------//
function HTMLCompanyAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Output/Retriever/CountyRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
	require_once("Struct/Element/Function/Select/SelectCountyRowRender.php");

	//-------------<PHP-HTML>-------------//
	print("<div class='Form'>");

	print("<form method='POST'>");

	print("<div>");

	//Title
	print("<div id='FormTitle'>");
	print("<h3>New Company</h3>");
	print("</div>");

	//Input Row
	print("<div>");
	print("<div>");
	print("<h5>Name</h5>");
	print("</div>");

	print("<div>");
	print("<input name='Name' type='text' placeholder='Company Name' required>");
	print("</div>");
	print("</div>");

	//Input Row
	print("<div>");
	print("<div>");
	print("<h5>creation date</h5>");
	print("</div>");

	print("<div>");
	print("<input name='Date' type='date' required>");
	print("</div>");
	print("</div>");

	//get rows and render <select> element with data
	print("<div>");
	print("<div>");
	print("<h5>County</h5>");
	print("</div>");

	print("<div>");
	RenderCountySelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
	print("</div>");
	print("</div>");

	//get rows and render <select> element with data
	print("<div>");
	print("<div>");
	print("<h5>Access Type</h5>");
	print("</div>");

	print("<div>");
	RenderAccessSelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
	print("</div>");
	print("</div>");

	print("</div>");

	//Input Buttons
	print("<div>");
	printf("<a href='.?MenuIndex=%d'><div><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Company']);
	printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
	print("</div>");

	print("</form>");

	print("</div>");
}
?>