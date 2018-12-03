<?php
require_once("../Data/HeaderData/HeaderData.php");
require_once("../Data/ConnData/DBSessionToken.php");
session_start();

require_once("../DBConnManager.php");
require_once("../Output/Retriever/JobRetriever.php");

printf("<!DOCTYPE HTML>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Job Overview</title>");
printf("</head>");
printf("<body>");

$JobRows = JobGeneralRetriever();

foreach($JobRows as $JobRow => $JobData)
{
		printf("<br> <b>ID</b>: " . $JobData['JOB_ID']);
		printf("<br> <b>Company</b>: " . $JobData['COMP_Title']);
		printf("<br> <b>Company Date</b>: " . $JobData['COMP_Date']);
		printf("<br> <b>Job Name</b>: " . $JobData['JOB_Title']);
		printf("<br> <b>Job Date</b>: " . $JobData['JOB_Date']);
		printf("<br> <b>Price</b>: " . $JobData['JOB_Price']);
		printf("<br> <b>Payment in advance</b>: " . $JobData['JOB_PIA']);
		printf("<br> <b>Expences</b>: " . $JobData['JOB_Exp']);
		printf("<br> <b>Damage</b>: " . $JobData['JOB_Dam'] . "<br>");
}

printf("<br><a href='../Form/AddForm/AddJobForm.php'>Add new entry</a>");
printf("<br><a href='../Index.php'>Back</a>");

printf("</body>");
printf("</html>");

unset($JobRows);

?>
