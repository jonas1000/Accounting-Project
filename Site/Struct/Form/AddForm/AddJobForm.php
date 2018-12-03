<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");

require_once("Struct/Element/Function/Select/DBSelectRowRender.php");

require_once("Output/Retriever/CompanyRetriever.php");
require_once("Output/Retriever/AccessRetriever.php");

//-------------<PHP-HTML>-------------//
printf("<form action='../../Input/Parser/AddParser/AddJobParser.php' method='POST'>");

printf("<p>Name</p><input name='Name' type='text' placeholder='Job name' required>");

printf("<p>Price</p><input name='Price' type='number' placeholder='Job price' required>");

printf("<p>Payment in advance</p><input name='PIA' type='number' placeholder='Job Payment in advance' required>");

printf("<p>Expenses</p><input name='Expenses' type='number' placeholder='Job expensess' required>");

printf("<p>Damage</p><input name='Damage' type='number' placeholder='Job Damage expensess' required>");

printf("<p>Date</p><input name='Date' type='Date' required>");

RenderCompanySelectRow();

RenderAccessSelectRow();

printf("<input type='submit' value='Save'>");

printf("</form>");

printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."'><div class='Button-Left'><p>Cancel</p></div></a>");
?>
