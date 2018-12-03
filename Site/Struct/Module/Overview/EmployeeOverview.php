<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/EmployeeRetriever.php");

//-------------<PHP-HTML>-------------//
switch(!isset($_GET['bIsForm']))
{
	//if $_GET['FormIndex'] is set
	case TRUE:
	{
		$EmployeeRows = EmployeeGeneralRetriever();

		foreach($EmployeeRows as $EmployeeRow => $EmployeeData)
		{
				printf("<div class='DataBlock'>");
				printf("<div>");
				printf("<div>");

				printf("<form method='POST'>");

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

		printf("<a href=.?MenuIndex=".$_GET['MenuIndex']."&bIsForm=1><div class='Button-Left'><p>Add</p></div></a>");

		unset($EmployeeRows);
		break;
	}

	//if $_GET['FormIndex'] is NOT set
	case FALSE:
	{
		switch($_GET['bIsForm'])
		{
			case TRUE:
			{
				require_once("Struct/Form/AddForm/AddEmployeeForm.php");
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
