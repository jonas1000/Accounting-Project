<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/CompanyRetriever.php");

$CompRows = CompanyGeneralRetriever();

printf("<div class='DataBlock'>");
printf("<div>");

printf("<div>");
foreach($CompRows as $CompRow => $CompData)
{
		printf("<form method='POST'>");

		printf("<div>");
		printf("<h3> " . $CompData['COMP_Title'] . "</h3>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Company Date:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p> " . $CompData['COMP_Date'] . "</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Country:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p> " . $CompData['COU_Title'] . "</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Tax:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p> " . $CompData['COU_Tax'] . "</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Interest Rate:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p> " . $CompData['COU_IR'] . "</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Country Date:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p> " . $CompData['COU_Date'] . "</p>");
		printf("</div>");

		printf("<input type='hidden' name='EditIndex' value=".$CompData['COMP_ID'].">");
		printf("<input type='submit' value='Delete' formaction='DelEntry.php'>");
		printf("<input type='submit' value='Edit' formaction='Struct/Module/Overview/CompanyOverview.php'>");
		printf("</form>");
}
printf("</div>");
printf("</div>");
printf("</div>");
printf("<a href='Form/AddForm/AddCompanyForm.php'><div class='Button-Left'><p>Add</p></div></a>");
unset($CompRows);

?>
