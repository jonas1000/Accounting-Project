<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");

require_once("Struct/Element/Function/Select/DBSelectRowRender.php");

require_once("Output/Retriever/AccessRetriever.php");
require_once("Output/Retriever/CompanyRetriever.php");
require_once("Output/Retriever/EmployeeRetriever.php");

//-------------<PHP-HTML>-------------//
printf("<form action='Input/Parser/AddParser/AddEmployeeParser.php' method='POST'>");
printf("<p>Name</p><input type='text' name='Name' placeholder='Employee Name' required><br>");
printf("<p>Temporary Password</p><input type='password' placeholder='Employee Temporary PassWord' name='Pass' required><br>");
printf("<p>Email</p><input type='email' name='Email' placeholder='Employee Email' required><br>");
printf("<p>Salary</p><input type='number' name='Salary' placeholder='Employee Salary'><br>");
printf("<p>Birth Date</p><input type='date' name='BDay' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' required><br>");

RenderAccessSelectRow();
RenderCompanySelectRow();
RenderEmployeePosSelectRow();

printf("<input type='submit' value='Add'><br>");
printf("</form>");

printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."'><div class='Button-Left'><p>Cancel</p></div></a>");
?>
