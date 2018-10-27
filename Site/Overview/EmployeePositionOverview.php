<?php
require("../Data/HeaderData/HeaderData.php");

require("../Output/Retriever/EmployeePositionRetriever.php");

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

printf("</body>");
printf("</html>");

?>
