<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("Struct/Element/Function/Select/DBSelectRowRender.php");

require_once("DBConnManager.php");
require_once("Output/Retriever/AccessRetriever.php");

//-------------<PHP-HTML>-------------//
printf("<form action='../../Input/Parser/AddParser/AddEmployeePositionParser.php' method='POST'>");

printf("<p>Title</p><input type='text' name='Name' placeholder='title position'>");

RenderAccessSelectRow();

printf("<input type='submit' value='submit'>");

printf("</form>");

printf("<a href='.?MenuIndex=3'><div class='Button-Left'><p>Cancel</p></div></a>");
?>
