<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/EmployeeRetriever.php");

//-------------<PHP-HTML>-------------//
switch(!isset($_GET['bIsForm']))
{
	case TRUE:
	{
		$EmpPosRows = EmployeePositionRetriever();

		foreach($EmpPosRows as $EmpPosRow => $EmpPosData)
		{
				printf("<div class='DataBlock'>");
				printf("<div>");
				printf("<div>");

				printf("<form method='POST'>");

				printf("<div>");
		 		printf("<h3>".$EmpPosData['EMP_Title']."<h3>");
				printf("</div>");

				printf("<input type='hidden' value=".$EmpPosData['EMP_ID'].">");
				printf("<input type='submit' value='Delete' formaction='DeleteEntry.php'>");
				printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");

				printf("</form>");

				printf("</div>");
				printf("</div>");
				printf("</div>");
		}

		printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&bIsForm=1'><div class='Button-Left'><p>Add</p></div></a>");

		unset($EmpPosRows);

		break;
	}

	case FALSE:
	{
		switch($_GET['bIsForm'])
		{
			case TRUE:
			{
				require_once("Struct/Form/AddForm/AddEmployeePositionForm.php");
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
