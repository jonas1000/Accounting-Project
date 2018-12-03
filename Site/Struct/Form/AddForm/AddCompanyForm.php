<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("Struct/Element/Function/Select/DBSelectRowRender.php");

//-------------<PHP-HTML>-------------//

//check if session is initialized properly
switch(isset($_SESSION['Access_ID']))
{
	//if $_SESSION['Access_ID'] is set
	case TRUE:
	{
		require_once("DBConnManager.php");
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Output/Retriever/CountryRetriever.php");
		require_once("Output/Retriever/CountyRetriever.php");
		require_once("Element/Form.php");
		require_once("Element/Input.php");

		printf("<div class='Form'>");
		printf("<form action='../../Input/Parser/AddParser/AddCompanyParser.php' method='POST'>");

		printf("<p>Name</p><input name='Name' type='text' placeholder='Studio Name'>");

		printf("<p>creation date</p><input name='Date' type='date'>");

		//get rows and render <select> element with data
		RenderAccessSelectRow();

		RenderCountySelectRow();

		RenderCountrySelectRow();

		printf("<input type='submit' value='Save'>");

		printf("</form>");
		printf("</div>");

		printf("<br><a href='.?MenuIndex=0'><div class='Button-Left'><p>Cancel</p></div></a>");

		break;
	}

	//if $_SESSION['Access_ID'] is NOT set
	case FALSE:
	{
		header("Location:../../");
	}

	//on undefined case, execute the default
	default:
		printf("<br>Unknown error detected");
}
?>
