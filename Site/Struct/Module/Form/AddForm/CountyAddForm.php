<?php
//-------------<FUNCTION>-------------//
function HTMLCountyAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Output/Retriever/CountryRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
	require_once("Struct/Element/Function/Select/SelectCountryRowRender.php");

  //-------------<PHP-HTML>-------------//
  printf("<div class='Form'>");

  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New County</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Name</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='text' placeholder='County name' name='Name' required>");
  printf("</div>");
  printf("</div>");

	//Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Tax</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='number' placeholder='County Tax' name='Tax' step='0.01' min='0.00' max='100.00'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Interest Rate</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='number' placeholder='County Interest Rate' name='IR' step='0.01' min='0.00' max='100.00'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Date</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='Date' placeholder='County modification date' name='Date' required>");
  printf("</div>");
  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");
  printf("<div>");
  printf("<h5>Country</h5>");
  printf("</div>");

  printf("<div>");
  RenderCountrySelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
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
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro'>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['County']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("</div>");

  printf("</form>");

  printf("</div>");
}
?>
