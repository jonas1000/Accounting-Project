<?php
require_once("../Data/HeaderData/HeaderData.php");
require_once("../Data/ConnData/DBSessionToken.php");
session_start();

require_once("../DBConnManager.php");
require_once("../Output/Retriever/CountryRetriever.php");

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
}

printf("<br><a href='../Form/AddForm/AddCountryForm.php'>Add new entry</a>");
printf("<br><a href='../Index.php'>Back</a>");

printf("</body>");
printf("</html>");

unset($CountryRows);

?>
