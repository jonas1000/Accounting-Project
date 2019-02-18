<?php
//-------------<FUNCTION>-------------//
function HTMLEmployeeAddForm(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/AccessRetriever.php");
	require_once("Output/Retriever/CompanyRetriever.php");
	require_once("Output/Retriever/EmployeeRetriever.php");
	require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
	require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
	require_once("Struct/Element/Function/Select/SelectEmployeePositionRowRender.php");

  //-------------<PHP-HTML>-------------//
  printf("<div class='Form'>");
  printf("<form method='POST'>");
  printf("<div>");

  //Title
  printf("<div id='FormTitle'>");
  printf("<h3>New Employee</h3>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Name</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='text' name='Name' placeholder='Employee Name' required>");
  printf("</div>");
  printf("</div>");

	//Input Row
	printf("<div>");
	printf("<div>");
	printf("<h5>Surname</h5>");
	printf("</div>");

	printf("<div>");
	printf("<input type='text' name='Surname' placeholder='Employee Surname' required>");
	printf("</div>");
	printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Temporary Password</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='password' placeholder='Employee Temporary Password' name='Pass' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Email</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='email' name='Email' placeholder='Employee Email' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Salary</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='number' name='Salary' min='0.00' step='0.01' placeholder='Employee Salary'>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Birth Date</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='date' name='BDay' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Phone Number</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='tel' max='16' name='PN' required>");
  printf("</div>");
  printf("</div>");

  //Input Row
  printf("<div>");
  printf("<div>");
  printf("<h5>Stable Number</h5>");
  printf("</div>");

  printf("<div>");
  printf("<input type='tel' max='16' name='SN'>");
  printf("</div>");
  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");
  printf("<div>");
  printf("<h5>Company</h5>");
  printf("</div>");

  printf("<div>");
  RenderCompanySelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
  printf("</div>");
  printf("</div>");

  //get rows and render <select> element with data
  printf("<div>");
  printf("<div>");
  printf("<h5>Position</h5>");
  printf("</div>");

  printf("<div>");
  RenderEmployeePosSelectRow($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);
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
  printf("<input type='submit' value='Save' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&AddPro' >");
  printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Employee']."'><div class='Button-Left'><p>Cancel</p></div></a>");
  printf("</div>");

  printf("</div>");
  printf("</form>");
}
?>
