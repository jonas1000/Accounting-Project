<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/AccessRetriever.php");
require_once("Struct/Element/Function/Select/DBSelectRowRender.php");

//-------------<PHP-HTML>-------------//
printf("<form action='../../Input/Parser/AddParser/AddCountryParser.php' method='POST'>");

printf("<p>Name</p><input type='text' placeholder='Country name' name='Name'>");

RenderAccessSelectRow();

printf("<input type='submit' value='Save'>");

printf("</form>");

printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."'><div class='Button-Left'><p>Cancel</p></div></a>");
?>
