<?php
//-------------<FUNCTION>-------------//
function HTMLCountryAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");

  //-------------<PHP-HTML>-------------//
  print("<div class='Form'>");

  print("<form method='POST'>");
  print("<div>");

  //Title
  print("<div id='FormTitle'>");
  print("<h3>New Country</h3>");
  print("</div>");

  //Input Row
  print("<div>");

  print("<div>");
  print("<h5>Name</h5>");
  print("</div>");

  print("<div>");
  print("<input type='text' placeholder='Country name' name='Name' required>");
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
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
  printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Country']);
  print("</div>");
  print("</form>");

  print("</div>");
}
?>
