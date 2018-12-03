<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/ShareholderRetriever.php");

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

printf("<br><a href='../Form/AddForm/AddShareholderForm.php'>Add new entry</a>");
printf("<br><a href='../Index.php'>Back</a>");

printf("</body>");
printf("</html>");

unset($ShareRows);

?>
