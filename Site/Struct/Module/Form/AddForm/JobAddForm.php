<?php
//-------------<FUNCTION>-------------//
function HTMLJobAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Output/Retriever/CompanyRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
	require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");

  //-------------<PHP-HTML>-------------//
  print("<div class='Form'>");
  print("<form method='POST'>");
  print("<div>");

  print("<div id='FormTitle'>");
  print("<h3>New Job</h3>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Name</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Name' type='text' placeholder='Job name' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Price</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Price' step='0.01' min='0.0' type='number' placeholder='Job price'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Payment in advance</h5>");
  print("</div>");

  print("<div>");
  print("<input name='PIA' type='number' step='0.01' min='0.0' placeholder='Job Payment in advance'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Expenses</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Expenses' type='number' step='0.01' min='0.0' placeholder='Job expensess'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Damage</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Damage' type='number' step='0.01' min='0.0' placeholder='Job Damage expensess'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Date</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Date' type='Date' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Company</h5>");
  print("</div>");

  print("<div>");
  RenderCompanySelectRow($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
  print("</div>");
  print("</div>");

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
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
  printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Job']);
  print("</div>");

  print("</form>");
  print("</div>");
}
?>
