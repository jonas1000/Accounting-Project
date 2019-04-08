<?php
//-------------<FUNCTION>-------------//
function HTMLJobAssigmentAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
  require_once("Struct/Element/Function/Select/DBSelectRender.php");

  //-------------<PHP-HTML>-------------//
  print("<div class='Form'>");
  print("<form method='POST'>");
  print("<div>");

  //Title
  print("<div id='FormTitle'>");
  print("<h3>New Job Assigment</h3>");
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
  print("<input name='Price' type='number' placeholder='Job price' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Payment in advance</h5>");
  print("</div>");

  print("<div>");
  print("<input name='PIA' type='number' placeholder='Job Payment in advance'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Expenses</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Expenses' type='number' placeholder='Job expensess'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Damage</h5>");
  print("</div>");

  print("<div>");
  print("<input name='Damage' type='number' placeholder='Job Damage expensess'>");
  print("</div>");
  print("</div>");

  //get rows and render <select> element with data
  print("<div>");
  print("<div>");
  print("<h5>Company</h5>");
  print("</div>");

  print("<div>");
  RenderCompanySelectRow();
  print("</div>");
  print("</div>");

  //get rows and render <select> element with data
  print("<div>");
  print("<div>");
  print("<h5>Access</h5>");
  print("</div>");

  print("<div>");
  RenderAccessSelectRow();
  print("</div>");
  print("</div>");

  print("</div>");

  print("<div>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['JobAssigment']."'><div class='Button-Left'><h5>Cancel</h5></div></a>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&ProAdd'>");
  print("</div>");

  print("</form>");
  print("</div>");
}
?>
