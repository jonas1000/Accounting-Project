<?php
require_once("../../Data/HeaderData/HeaderData.php");
require_once("../../Data/ConnData/DBSessionToken.php");

session_start();

//-------------<FUNCTIONS>-------------//
function DisplayAccessSelectRow()
{
	$AccessRows = AccessFormRetriever();

	printf("<p>Access Level</p><select name='Access'>");

	foreach($AccessRows as $AccessRow => $AccessData)
	{

		printf("<option value='". $AccessData['ACCESS_ID'] ."'>". $AccessData['ACCESS_Title'] ."</option>");

	}
	printf("</select><br>");

	unset($AccessRows);
}

function DisplayCountrySelectRow()
{
	$CountryRows = CountryFormRetriever();

	printf("<p>Country</p><select name='Country'>");

	foreach($CountryRows as $CountryRow => $CountryData)
	{

		printf("<option value='". $CountryData['COU_ID'] ."'>". $CountryData['COU_Title'] ."</option>");

	}
	printf("</select><br>");

	unset($CountryRows);
}

function DisplayCountySelectRow()
{
	$CountyRows = CountyFormRetriever();

	printf("<p>County</p><select name='Country'>");

	foreach($CountyRows as $CountyRow => $CountyData)
	{

		printf("<option value='". $CountyData['COU_ID'] ."'>". $CountyData['COU_Title'] ."</option>");

	}
	printf("</select><br>");

	unset($CountyRows);
}

//-------------<PHP-HTML>-------------//
switch(isset($_SESSION['Access_ID']))
{
	case TRUE:
	{
		require_once("../../DBConnManager.php");
		require_once("../../Output/Retriever/AccessRetriever.php");
		require_once("../../Output/Retriever/CountryRetriever.php");
		require_once("../../Output/Retriever/CountyRetriever.php");
		require_once("../../Element/Form.php");
		require_once("../../Element/Input.php");

		printf("<!DOCTYPE html>");
		printf("<html>");

		printf("<head>");
		printf("<meta charset=utf8>");
		printf("<title>Home</title>");
		printf("</head>");

		printf("<body>");

		printf("<form action='../../Input/Parser/AddParser/AddCompanyParser.php' method='POST'>");

		printf("<p>Name</p><input name='Name' type='text' placeholder='Studio Name'>");

		printf("<p>creation date</p><input name='Date' type='date'>");

		DisplayAccessSelectRow();

		DisplayCountySelectRow();

		DisplayCountrySelectRow();

		printf("<input type='submit' value='Save'>");

		printf("</form>");

		printf("<br><a href='../../'>Back</a>");

		printf("</body>");

		printf("</html>");

		break;
	}
	case FALSE:
	{
		header("Location:../../");
	}
	default:
		printf("<br>Unknown error detected");
}
?>
