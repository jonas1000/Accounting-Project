<?php
require("../Data/HeaderData/HeaderData.php");

require("../Output/Retriever/ShareholderRetriever.php");

printf("<!DOCTYPE HTML>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Shareholder Overview</title>");
printf("</head>");
printf("<body>");

$ShareRows = ShareholderGeneralRetriever();

foreach($ShareRows as $ShareRow => $ShareData)
{
		printf("<br> <b>ID</b>: " . $ShareData['SHARE_ID']);
		printf("<br> <b>Salary</b>: " . $ShareData['EMP_Salary']);
		printf("<br> <b>Birth Date</b>: " . $ShareData['EMP_BDay']);
		printf("<br> <b>Name</b>: " . $ShareData['EMP_Name']);
		printf("<br> <b>Email</b>: " . $ShareData['EMP_Email']);
		printf("<br> <b>Title</b>: " . $ShareData['EMP_Title']);
}

printf("</body>");
printf("</html>");

?>
