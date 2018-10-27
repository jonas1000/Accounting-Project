<?php
require("../Data/HeaderData/HeaderData.php");

require("../Output/Retriever/CountryRetriever.php");

printf("<!DOCTYPE HTML>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Country Overview</title>");
printf("</head>");
printf("<body>");

$CountryRows = CountryGeneralRetriever();

foreach($CountryRows as $CountryRow => $CountryData)
{
		printf("<br> <b>ID</b>: " . $CountryData['COU_ID']);
		printf("<br> <b>Name</b>: " . $CountryData['COU_Title']);
		printf("<br> <b>Country Date</b>: " . $CountryData['COU_Date']);
		printf("<br> <b>Tax</b>: " . $CountryData['COU_Tax']);
		printf("<br> <b>Interest Rate</b>: " . $CountryData['COU_IR']);
}

printf("</body>");
printf("</html>");

?>
