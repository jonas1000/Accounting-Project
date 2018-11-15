<?php
require_once("../Data/HeaderData/HeaderData.php");
require_once("../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../DBConnManager.php");
require_once("../Output/Retriever/CompanyRetriever.php");

printf("<!DOCTYPE HTML>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Company Overview</title>");
printf("</head>");
printf("<body>");

$CompRows = CompanyGeneralRetriever();

foreach($CompRows as $CompRow => $CompData)
{
		printf("<br> <b>ID</b>: " . $CompData['COMP_ID']);
		printf("<br> <b>Name</b>: " . $CompData['COMP_Title']);
		printf("<br> <b>Company Date</b>: " . $CompData['COMP_Date']);
		printf("<br> <b>Country</b>: " . $CompData['COU_Title']);
		printf("<br> <b>Tax</b>: " . $CompData['COU_Tax']);
		printf("<br> <b>Interest Rate</b>: " . $CompData['COU_IR']);
		printf("<br> <b>Country Date</b>: " . $CompData['COU_Date']);
}

printf("<br><a href='../Form/AddForm/AddCompanyForm.php'>Add new entry</a>");
printf("<br><a href='../Index.php'>Back</a>");

printf("</body>");
printf("</html>");

unset($CompRows);

?>
