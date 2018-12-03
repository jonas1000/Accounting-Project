<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/EmployeeRetriever.php");

$EmployeeRows = EmployeeGeneralRetriever();

foreach($EmployeeRows as $EmployeeRow => $EmployeeData)
{
		printf("<div class='DataBlock'>");
		printf("<div>");
		printf("<div>");

		printf("<form>");

		printf("<div>");
		printf("<h3>".$EmployeeData['EMP_Name']."</h3>");
		printf("</div>");

		printf("<div>");
		printf("<h4><b>Email:</b></h4>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$EmployeeData['EMP_Email']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Salary</h4></b>");
		printf("</div>");

		printf("<div>");
 		printf("<p>".$EmployeeData['EMP_Sal']."<p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Title:</h4></b>");
		printf("</div>");

		printf("<div>");
 		printf("<p>".$EmployeeData['EMP_Title']."<p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Birth Day:</h4></b>");
		printf("</div>");

		printf("<div>");
 		printf("<p>".$EmployeeData['EMP_BDay']."<p>");
		printf("</div>");

		printf("<input type='hidden' name='EditIndex' value=".$EmployeeData['EMP_ID'].">");
		printf("<input type='submit' value='Delete' formaction='DeleteEntry.php'>");
		printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");

		printf("</form>");

		printf("</div>");
		printf("</div>");
		printf("</div>");
}

printf("<a href='Form/AddForm/AddEmployeeForm.php'><div class='Button-Left'>Add</div></a>");

unset($EmployeeRows);

?>
