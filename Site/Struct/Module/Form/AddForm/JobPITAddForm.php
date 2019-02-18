<?php
//-------------<FUNCTION>-------------//
function HTMLJobPITAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");

  printf("<div class='Form'>");

  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New Payment</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Payment</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='number' name='PIT'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Date</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='date' name='Date' required>");
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

  printf("<div>");
  printf("<input type='hidden' name='JobIndex' value='".$_POST['JobIndex']."'>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Job']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&SubModule=".$_GET['SubModule']."&AddPro'>");
  printf("</div>");
  printf("</form>");

  printf("</div>");
}
?>
