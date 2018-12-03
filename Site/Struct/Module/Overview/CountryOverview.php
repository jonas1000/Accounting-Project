<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/CountryRetriever.php");

//-------------<PHP-HTML>-------------//
switch(!isset($_GET["bIsForm"]))
{
	case TRUE:
	{
		$CountryRows = CountryGeneralRetriever();

		foreach($CountryRows as $CountryRow => $CountryData)
		{
				printf("<div class='DataBlock'>");
				printf("<div>");
				printf("<div>");

				printf("<form method='POST'>");

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

				printf("</div>");
				printf("</div>");
				printf("</div>");
		}

		printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&bIsForm=1'><div class='Button-Left'><p>Add</p></div></a>");
		unset($CountryRows);

		break;
	}

	case FALSE:
	{
		switch($_GET["bIsForm"])
		{
			case TRUE:
			{
				require_once("Struct/Form/AddForm/AddCountryForm.php");
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
