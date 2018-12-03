<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/ShareholderRetriever.php");

//-------------<PHP-HTML>-------------//

switch(!isset($_GET['bIsForm']))
{
	case TRUE:
	{
		$ShareRows = ShareholderGeneralRetriever();

		foreach($ShareRows as $ShareRow => $ShareData)
		{
				printf("<div class='DataBlock'>");
				printf("<div>");
				printf("<div>");

				printf("<form method='POST'>");

				printf("<div>");
		 		printf("<h3>".$ShareData['EMP_Name']."</h3>");
				printf("</div>");

				printf("<div>");
				printf("<b><h4>Salary:</h4></b>");
				printf("</div>");

				printf("<div>");
				printf("<p>".$ShareData['EMP_Salary']."</p>");
				printf("</div>");

				printf("<div>");
				printf("<b><h4>Birth Date:</h4></b>");
				printf("</div>");

				printf("<div>");
				printf("<p>".$ShareData['EMP_BDay']."</p>");
				printf("</div>");

				printf("<div>");
				printf("<b><h4>Email:</h4></b>");
				printf("</div>");

				printf("<div>");
				printf("<p>".$ShareData['EMP_Email']."</p>");
				printf("</div>");

				printf("<div>");
				printf("<b><h4>Title:</h4></b>");
				printf("</div>");

				printf("<div>");
				printf("<p>".$ShareData['EMP_Title']."</p>");
				printf("</div>");

				printf("<input type='hidden' value='".$ShareData['SHARE_ID']."' name='ID'>");
				printf("<input type='submit' value='Delete' formaction='DeleteEntry.php'>");
				printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");

				printf("</form>");

				printf("</div>");
				printf("</div>");
				printf("</div>");
		}

		printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&bIsForm=1'><div class='Button-Left'><p>Add</p></div></a>");

		unset($ShareRows);
		break;
	}

	case FALSE:
	{
		switch($_GET['bIsForm'])
		{
			case TRUE:
			{
				require_once("Struct/Form/AddForm/AddShareholderForm.php");
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
