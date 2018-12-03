<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/CountryRetriever.php");

printf("<div class='DataBlock'>");
printf("<div>");
printf("<div>");

$CountryRows = CountryGeneralRetriever();

foreach($CountryRows as $CountryRow => $CountryData)
{
		printf("<form>");

		printf("<div>");
		printf("<h3>".$CountryData['COU_Title']."</h3>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>ID:</h4></b>");
		printf("</div>");

		printf("<div>");
 		printf("<p>".$CountryData['COU_ID']."<p>");
		printf("</div>");

		printf("<input type='hidden' name='EditIndex' value=".$CountryData['COU_ID'].">");
		printf("<input type='submit' value='Delete' formaction='DelEntry.php'>");
		printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");
		printf("</form>");
}

printf("</div>");
printf("</div>");
printf("</div>");

printf("<br><a href='Form/AddForm/AddCountryForm.php'><div class='Button-Left'>Add</div></a>");

unset($CountryRows);

?>
