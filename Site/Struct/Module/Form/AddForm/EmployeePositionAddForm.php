<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeePositionAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
  //-------------<PHP-HTML>-------------//
  print("<div class='Form'>");
  print("<form method='POST'>");
  print("<div>");

  //Title
  print("<div id='FormTitle'>");
  print("<h3>New Employee Position</h3>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Title*</h5>");
  print("</div>");

  print("<div>");
  print("<input type='text' name='Name' placeholder='title position' required>");
  print("</div>");
  print("</div>");

  //get rows and render <select> element with data
  print("<div>");
  print("<div>");
  print("<h5>Access</h5>");
  print("</div>");

  print("<div>");
  RenderAccessSelectRow($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);
  print("</div>");
  print("</div>");

  print("</div>");

  //Button Input
  print("<div>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
  printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['EmployeePosition']);
  print("</div>");

  print("</form>");
  print("</div>");
}
?>
