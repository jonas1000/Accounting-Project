<?php

header("Content-Type: text/html; charset='utf-8'");

require("Output/Retriever/CompanyRetriever.php");

$CompRows = CompanyGeneralRetriever();

foreach($CompRows as $CompRow => $CompData)
{
		printf("<br> <b>ID</b>: " . $CompData['COMP_ID']);
		printf("<br> <b>Name</b>: " . $CompData['COMP_Title']);
		printf("<br> <b>Company Date</b>: " . $CompData['COMP_Date']);
		printf("<br> <b>Job Date</b>: " . $CompData['JOB_Date']);
		printf("<br> <b>Price</b>: " . $CompData['JOB_Price']);
		printf("<br> <b>Payment in advance</b>: " . $JobData['JOB_PIA']);
		printf("<br> <b>Expences</b>: " . $CompData['JOB_Exp']);
		printf("<br> <b>Damage</b>: " . $CompData['JOB_Dam'] . "<br>");
}


?>
