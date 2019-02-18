<?php
//-------------<FUNCTION>-------------//
function HTMLShareholderAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Output/Retriever/EmployeeRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
	require_once("Struct/Element/Function/Select/SelectEmployeeRowRender.php");

  printf("<div class='Form'>");
  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New Shareholder</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Employee</h5>");
  printf("</div>");

  printf("<div>");
  RenderEmployeeSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");
  printf("</div>");

	//Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Access</ph5>");
  printf("</div>");

  printf("<div>");
  RenderAccessSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");
  printf("</div>");

  printf("</div>");

  printf("<div>");
  printf("<input type='hidden' name='MenuIndex' value='".$_GET['MenuIndex']."'>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro'>");
  printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("</div>");

  printf("</form>");

  printf("</div>");
}
?>
