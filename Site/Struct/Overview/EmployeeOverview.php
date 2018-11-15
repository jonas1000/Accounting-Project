<?php
require_once("../Data/HeaderData/HeaderData.php");
require_once("../Data/ConnData/DBSessionToken.php");
session_start();

require_once("../DBConnManager.php");
require_once("../Output/Retriever/EmployeeRetriever.php");

printf("<!DOCTYPE HTML>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Employee Overview</title>");
printf("</head>");
printf("<body>");

$EmployeeRows = EmployeeGeneralRetriever();

foreach($EmployeeRows as $EmployeeRow => $EmployeeData)
{
		printf("<br> <b>ID</b>: " . $EmployeeData['EMP_ID']);
		printf("<br> <b>Name</b>: " . $EmployeeData['EMP_Name']);
		printf("<br> <b>Email</b>: " . $EmployeeData['EMP_Email']);
		printf("<br> <b>Salary</b>: " . $EmployeeData['EMP_Sal']);
		printf("<br> <b>Title</b>: " . $EmployeeData['EMP_Title']);
		printf("<br> <b>Birth Day</b>: " . $EmployeeData['EMP_BDay'] . "<br>");
}

printf("<a href='../Form/AddForm/AddEmployeeForm.php'>Add new entry</a>");
printf("<br><a href='../Index.php'>Back</a>");

printf("</body>");
printf("</html>");

unset($EmployeeRows);

?>
