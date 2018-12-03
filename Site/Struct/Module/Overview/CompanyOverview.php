<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/CompanyRetriever.php");

//-------------<PHP-HTML>-------------//
switch(!isset($_GET['bIsForm']))
{
	//if $_GET['FormIndex'] does NOT exists, load data
	case TRUE:
	{
		$CompRows = CompanyGeneralRetriever();

		foreach($CompRows as $CompRow => $CompData)
		{
				printf("<div class='DataBlock'>");
				printf("<div>");
				printf("<div>");

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
				printf("<input type='submit' value='Edit' formaction='EditEntry.php'>");
				printf("</form>");

				printf("</div>");
				printf("</div>");
				printf("</div>");
		}
		printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&bIsForm=1'><div class='Button-Left'><p>Add</p></div></a>");

		unset($CompRows);
		break;
	}

	//if $_GET['FormIndex'] exists then load the add form
	case FALSE:
	{
		switch($_GET['bIsForm'])
		{
			case TRUE:
			{
				require_once("Struct/Form/AddForm/AddCompanyForm.php");
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
