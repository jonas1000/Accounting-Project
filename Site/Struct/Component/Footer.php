<?php

printf("<div class='Footer'>");

printf("<div>");
printf("<h1>Footer</h1>");
if(isset($_SESSION['AppVersion']))
	printf("<p>Version:".$_SESSION['AppVersion']."</p>");
printf("</div>");

printf("</div>");

?>
