<?php
//-------------<FUNCTION>-------------//
function HTMLJobAssigmentAddForm(CDBConnManager &$InDBConn) : void
{
  require_once("Struct/Element/Function/Select/DBSelectRender.php");

  //-------------<PHP-HTML>-------------//
  printf("<div class='Form'>");
  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New Job Assigment</h3>");
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
  printf("<input name='Price' type='number' placeholder='Job price' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Payment in advance</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='PIA' type='number' placeholder='Job Payment in advance'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Expenses</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Expenses' type='number' placeholder='Job expensess'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Damage</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input name='Damage' type='number' placeholder='Job Damage expensess'>");
  printf("</div>");
  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");
  printf("<div>");
  printf("<h5>Company</h5>");
  printf("</div>");

  printf("<div>");
  RenderCompanySelectRow();
  printf("</div>");
  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");
  printf("<div>");
  printf("<h5>Access</h5>");
  printf("</div>");

  printf("<div>");
  RenderAccessSelectRow();
  printf("</div>");
  printf("</div>");

  printf("</div>");

  printf("<div>");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['JobAssigment']."'><div class='Button-Left'><h5>Cancel</h5></div></a>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro'>");
  printf("</div>");

  printf("</form>");
  printf("</div>");
}
?>
