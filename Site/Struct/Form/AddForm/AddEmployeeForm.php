<?php
require_once("../../Data/HeaderData/HeaderData.php");
require_once("../../Data/ConnData/DBSessionToken.php");

session_start();

//-------------<PHP-HTML>-------------//
require_once("../../DBConnManager.php");

require_once("../../Output/Retriever/AccessRetriever.php");
require_once("../../Output/Retriever/CompanyRetriever.php");
require_once("../../Output/Retriever/EmployeeRetriever.php");

printf("<!DOCTYPE html>");
printf("<html>");

printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Home</title>");
printf("</head>");

printf("<body>");

printf("<form action='../../Input/Parser/AddParser/AddEmployeeParser.php' method='POST'>");
printf("<p>Name</p><input type='text' name='Name' placeholder='Employee Name' required><br>");
printf("<p>Temporary Password</p><input type='password' placeholder='Employee Temporary PassWord' name='Pass' required><br>");
printf("<p>Email</p><input type='email' name='Email' placeholder='Employee Email' required><br>");
printf("<p>Salary</p><input type='number' name='Salary' placeholder='Employee Salary'><br>");
printf("<p>Birth Date</p><input type='date' name='BDay' pattern='[0-9]{4}-[0-9]{2}-[0-9]{2}' required><br>");

$CompRows = CompanyFormRetriever();

printf("<p>Company</p><select name='Company' required>");
foreach($CompRows as $CompRow => $CompData)
{
	printf("<option value=".$CompData['COMP_ID'].">".$CompData['COMP_Title']."</option>");
}
$CompRows = null;
printf("</select><br>");

$AccessRows = AccessFormRetriever();

printf("<p>Access</p><select name='Access' required>");
foreach($AccessRows as $AccessRow => $AccessData)
{
	printf("<option value=".$AccessData['ACCESS_ID'].">".$AccessData['ACCESS_Title']."</option>");
}
$AccessRows = null;
printf("</select><br>");

$EmpPosRows = EmployeeFormRetriever();

printf("<p>Position</p><select name='Position' required>");
foreach($EmpPosRows as $EmpPosRow => $EmpPosData)
{
	printf("<option value=".$EmpPosData['EMP_ID'].">".$EmpPosData['EMP_Title']."</option>");
}
$EmpPosRows = null;
printf("</select>");

printf("<input type='submit' value='Add'><br>");
printf("</form>");

printf("</body>");

printf("</html>");
?>
