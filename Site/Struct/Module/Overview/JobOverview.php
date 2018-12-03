<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/JobRetriever.php");

//-------------<PHP-HTML>-------------//
switch(!isset($_GET['bIsForm']))
{
	case TRUE:
	{
		$JobRows = JobGeneralRetriever();

		foreach($JobRows as $JobRow => $JobData)
		{
				printf("<div class='DataBlock'>");
				printf("<div>");
				printf("<div>");

				printf("<form method='POST'>");

				printf("<div>");
				printf("<h3>".$JobData['JOB_Title']."</h3>");
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
				printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");

				printf("</form>");

				printf("</div>");
				printf("</div>");
				printf("</div>");
		}

		printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&bIsForm=1'><div class='Button-Left'><p>Add</p></div></a>");

		unset($JobRows);

		break;
	}

	case FALSE:
	{
		switch($_GET['bIsForm'])
		{
			case TRUE:
			{
				require_once("Struct/Form/AddForm/AddJobForm.php");
				break;
			}

			default:
			{
				header("Location:Index.php");
			}
		}
		break;
	}

	default:
	{
		header("Location:Index.php");
	}
}
?>
