<?php
//-------------<FUNCTION>-------------//
function HTMLJobAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Output/Retriever/CompanyRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
	require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");

  //-------------<PHP-HTML>-------------//
  printf("<div class='Form'>");
  printf("<form method='POST'>");
  printf("<div>");

  printf("<div id='FormTitle'>");
  printf("<h3>New Job</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Name</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Name' type='text' placeholder='Job name' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Price</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Price' step='0.01' min='0.0' type='number' placeholder='Job price'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Payment in advance</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='PIA' type='number' step='0.01' min='0.0' placeholder='Job Payment in advance'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Expenses</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Expenses' type='number' step='0.01' min='0.0' placeholder='Job expensess'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Damage</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Damage' type='number' step='0.01' min='0.0' placeholder='Job Damage expensess'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Date</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Date' type='Date' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Company</h5>");
  printf("</div>");

  printf("<div>");
  RenderCompanySelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");
  printf("</div>");

  printf("<div>");
  printf("<div>");
  printf("<h5>Access</h5>");
  printf("</div>");

  printf("<div>");
  RenderAccessSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");
  printf("</div>");

  printf("</div>");

  printf("<div>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro'>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Job']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("</div>");

  printf("</form>");
  printf("</div>");
}
?>
