<?php

header("Content-Type: text/html; charset='utf-8'");

require("Output/Retriever/JobRetriever.php");

$JobRows = JobGeneralRetriever();

foreach($JobRows as $JobRow => $JobData)
{
		printf("<br> <b>ID</b>: " . $JobData['JOB_ID']);
		printf("<br> <b>Name</b>: " . $JobData['COMP_Title']);
		printf("<br> <b>Company Date</b>: " . $JobData['COMP_Date']);
		printf("<br> <b>Job Date</b>: " . $JobData['JOB_Date']);
		printf("<br> <b>Price</b>: " . $JobData['JOB_Price']);
		printf("<br> <b>Payment in advance</b>: " . $JobData['JOB_PIA']);
		printf("<br> <b>Expences</b>: " . $JobData['JOB_Exp']);
		printf("<br> <b>Damage</b>: " . $JobData['JOB_Dam'] . "<br>");
}


?>
