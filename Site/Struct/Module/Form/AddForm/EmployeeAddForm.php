<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeeAddForm(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
  //-------------<PHP-HTML>-------------//
  print("<div class='Form'>");
  print("<form method='POST'>");
  print("<div>");

  //Title
  print("<div id='FormTitle'>");
  print("<h3>New Employee</h3>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Name*</h5>");
  print("</div>");

  print("<div>");
  print("<input type='text' name='Name' placeholder='Employee Name' required>");
  print("</div>");
  print("</div>");

	//Input Row
	print("<div>");
	print("<div>");
	print("<h5>Surname*</h5>");
	print("</div>");

	print("<div>");
	print("<input type='text' name='Surname' placeholder='Employee Surname' required>");
	print("</div>");
	print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Temporary Password*</h5>");
  print("</div>");

  print("<div>");
  print("<input type='password' placeholder='Employee Temporary Password' name='Pass' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Email*</h5>");
  print("</div>");

  print("<div>");
  print("<input type='email' name='Email' placeholder='Employee Email' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Salary</h5>");
  print("</div>");

  print("<div>");
  print("<input type='number' name='Salary' min='0.00' step='0.01' placeholder='Employee Salary'>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Birth Date*</h5>");
  print("</div>");

  print("<div>");
  print("<input type='date' name='BDay' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Phone Number*</h5>");
  print("</div>");

  print("<div>");
  print("<input type='tel' max='16' name='PN' required>");
  print("</div>");
  print("</div>");

  //Input Row
  print("<div>");
  print("<div>");
  print("<h5>Stable Number</h5>");
  print("</div>");

  print("<div>");
  print("<input type='tel' max='16' name='SN'>");
  print("</div>");
  print("</div>");

  //get rows and render <select> element with data
  print("<div>");
  print("<div>");
  print("<h5>Company</h5>");
  print("</div>");

  print("<div>");
  RenderCompanySelectRow($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);
  print("</div>");
  print("</div>");

  //get rows and render <select> element with data
  print("<div>");
  print("<div>");
  print("<h5>Position</h5>");
  print("</div>");

  print("<div>");
  RenderEmployeePosSelectRow($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);
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

  print("<div>");
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=%d&Module=%d&ProAdd'>", $_GET['MenuIndex'], $_GET['Module']);
  printf("<a href='.?MenuIndex=%d'><div class='Button-Left'><p>Cancel</p></div></a>", $_ENV['MenuIndex']['Employee']);
  print("</div>");

  print("</div>");
  print("</form>");
}
?>
