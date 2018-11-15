<?php
require_once("../../Data/HeaderData/HeaderData.php");
require_once("../../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../Output/Retriever/CompanyRetriever.php");
require_once("../../Output/Retriever/AccessRetriever.php");

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

function DisplayCompanySelectRow()
{
	$CompRows = CompanyFormRetriever();

	printf("<p>Company</p><select name='Company'>");

	foreach($CompRows as $CompRow => $CompData)
	{

		printf("<option value='". $CompData['COMP_ID'] ."'>". $CompData['COMP_Title'] ."</option>");

	}
	printf("</select><br>");

	unset($AccessRows);
}

//-------------<PHP-HTML>-------------//
require_once("../../DBConnManager.php");

printf("<!DOCTYPE html>");
printf("<html>");

printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Home</title>");
printf("</head>");

printf("<body>");

printf("<form action='../../Input/Parser/AddParser/AddJobParser.php' method='POST'>");

printf("<p>Name</p><input name='Name' type='text' placeholder='Job name' required>");

printf("<p>Price</p><input name='Price' type='number' placeholder='Job price' required>");

printf("<p>Payment in advance</p><input name='PIA' type='number' placeholder='Job Payment in advance' required>");

printf("<p>Expenses</p><input name='Expenses' type='number' placeholder='Job expensess' required>");

printf("<p>Damage</p><input name='Damage' type='number' placeholder='Job Damage expensess' required>");

DisplayCompanySelectRow();

DisplayAccessSelectRow();

printf("<input type='submit' value='submit'>");

printf("</form>");

printf("</body>");

printf("</html>");
?>
