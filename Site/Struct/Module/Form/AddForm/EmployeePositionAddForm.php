<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeePositionAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");

  //-------------<PHP-HTML>-------------//
  printf("<div class='Form'>");
  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New Employee Position</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Title</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='text' name='Name' placeholder='title position' required>");
  printf("</div>");
  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");
  printf("<div>");
  printf("<h5>Access</h5>");
  printf("</div>");

  printf("<div>");
  RenderAccessSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");
  printf("</div>");

  printf("</div>");

  //Button Input
  printf("<div>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro'>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['EmployeePosition']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("</div>");

  printf("</form>");
  printf("</div>");
}
?>
