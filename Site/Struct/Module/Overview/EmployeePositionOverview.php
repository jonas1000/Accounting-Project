<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/EmployeeRetriever.php");

$EmpPosRows = EmployeePositionRetriever();

foreach($EmpPosRows as $EmpPosRow => $EmpPosData)
{
		printf("<div class='DataBlock'>");
		printf("<div>");
		printf("<div>");

		printf("<form>");

		printf("<div>");
 		printf("<h4>".$EmpPosData['EMP_Title']."<h4>");
		printf("</div>");

		printf("<input type='hidden' value=".$EmpPosData['EMP_ID'].">");
		printf("<input type='submit' value='Delete' formaction='DeleteEntry.php'>");
		printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");

		printf("</form>");

		printf("</div>");
		printf("</div>");
		printf("</div>");
}

printf("<br><a href='Form/AddForm/AddEmployeePositionForm.php'><div class='Button-Left'>Add</div></a>");

unset($EmpPosRows);

?>
