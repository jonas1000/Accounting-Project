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
printf("<title>Employee Position Overview</title>");
printf("</head>");
printf("<body>");

$EmpPosRows = EmployeePositionRetriever();

foreach($EmpPosRows as $EmpPosRow => $EmpPosData)
{
		printf("<br> <b>ID</b>: " . $EmpPosData['EMP_ID']);
		printf("<br> <b>Title</b>: " . $EmpPosData['EMP_Title'] . "<br>");
}

printf("<br><a href='../Form/AddForm/AddEmployeePositionForm.php'>Add new entry</a>");
printf("<br><a href='../Index.php'>Back</a>");

printf("</body>");
printf("</html>");

unset($EmpPosRows);

?>
