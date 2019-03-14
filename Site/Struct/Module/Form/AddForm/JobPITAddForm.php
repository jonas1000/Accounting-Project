<?php
//-------------<FUNCTION>-------------//
function HTMLJobPITAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");

  print("<div class='Form'>");

  print("<form method='POST'>");
  print("<div>");

  //Title
  print("<div id='FormTitle'>");
  print("<h3>New Payment</h3>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Payment</h5>");
  print("</div>");

  print("<div>");
  print("<input type='number' name='PIT'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Date</h5>");
  print("</div>");

  print("<div>");
  print("<input type='date' name='Date' required>");
  print("</div>");
  print("</div>");

	//get rows and render <select> element with data
  print("<div>");
  print("<div>");
  print("<h5>Access</h5>");
  print("</div>");

  print("<div>");
  RenderAccessSelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
  print("</div>");
  print("</div>");

  print("</div>");

  print("<div>");
  printf("<input type='hidden' name='JobIndex' value='%d'>", $_POST['JobIndex']);
  printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Job']);
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&SubModule=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module'], $_GET['SubModule']);
  print("</div>");
  print("</form>");

  print("</div>");
}
?>