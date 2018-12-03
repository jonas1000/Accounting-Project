<?php
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("DBConnManager.php");

require_once("Struct/Element/Function/Select/DBSelectRowRender.php");

printf("<form method='POST'>");

RenderAccessSelectRow();
RenderEmployeeSelectRow();

printf("<input type='submit' value='Save'>");
printf("</form>");

printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."'><div class='Button-Left'><p>Cancel</p></div></a>");
?>
