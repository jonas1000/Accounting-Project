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

//-------------<PHP-HTML>-------------//
require_once("../../DBConnManager.php");
require_once("../../Output/Retriever/AccessRetriever.php");

printf("<!DOCTYPE html>");
printf("<html>");

printf("<head>");
printf("<meta charset=utf8>");
printf("<title>Home</title>");
printf("</head>");

printf("<body>");

printf("<form action='../../Input/Parser/AddParser/AddEmployeePositionParser.php' method='POST'>");

printf("<p>Title</p><input type='text' name='Name' placeholder='title position'>");

DisplayAccessSelectRow();

printf("<input type='submit' value='submit'>");

printf("</form>");

printf("</body>");

printf("</html>");
?>
