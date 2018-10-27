<?php
require("../Data/HeaderData/HeaderData.php");

require("../Output/Retriever/EmployeeRetriever.php");

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
		printf("<br> <b>Country Date</b>: " . $EmployeeData['EMP_Email']);
		printf("<br> <b>Tax</b>: " . $EmployeeData['EMP_Sal']);
		printf("<br> <b>Interest Rate</b>: " . $EmployeeData['EMP_Title']);
		printf("<br> <b>Interest Rate</b>: " . $EmployeeData['EMP_BDay'] . "<br>");
}

printf("</body>");
printf("</html>");

?>
