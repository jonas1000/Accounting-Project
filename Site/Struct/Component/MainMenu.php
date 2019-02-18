<?php

printf("<div class='MenuWindow'>");
printf("<div class='MainMenu' id='MainMenu'>");
printf("<div>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Company']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Company Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Country']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Country Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Employee']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Employee Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['EmployeePosition']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Employee Position Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Job']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Job Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Shareholder']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Shareholder Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['Customer']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>Customer Overview</p>");
printf("</div>");
printf("</a>");

printf("<a href='.?MenuIndex=".$_ENV['MenuIndex']['County']."'>");
printf("<div class='MainMenuButton'>");
printf("<p>County Overview</p>");
printf("</div>");
printf("</a>");

printf("</div>");
printf("</div>");

printf("<div class='MenuButton' onclick='RenderMenuDisplay()'>");
printf("</div>");

printf("</div>");

?>
