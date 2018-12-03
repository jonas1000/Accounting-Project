<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/JobRetriever.php");

$JobRows = JobGeneralRetriever();


foreach($JobRows as $JobRow => $JobData)
{
		printf("<div class='DataBlock'>");
		printf("<div>");
		printf("<div>");

		printf("<div>");
		printf("<h4>".$JobData['JOB_Title']."</h4>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Company:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['COMP_Title']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Company Date:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['COMP_Date']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Job Date:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['JOB_Date']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Price:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['JOB_Price']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Payment in advance:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['JOB_PIA']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Expences:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['JOB_Exp']."</p>");
		printf("</div>");

		printf("<div>");
		printf("<b><h4>Damage:</h4></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobData['JOB_Dam']."</p>");
		printf("</div>");

		printf("<input type='hidden' value=".$JobData['JOB_ID'].">");
		printf("<input type='submit' value='Delete' formaction='DeleteEntry.php'>");
		printf("<input type='submit' value='Edit' formaction='EditEntry.php'");

		printf("</div>");
		printf("</div>");
		printf("</div>");
}

printf("<a href='Form/AddForm/AddJobForm.php'><div class='Button-Left'>Add</div></a>");

unset($JobRows);

?>
