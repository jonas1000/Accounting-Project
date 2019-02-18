<?php
printf("<div>");
printf("<img src='../images/Warning.png'");
printf("<h3>Access is denied</h3>");
printf("<p>redirecting in 3 seconds</p>");
printf("</div>");

header("refresh: 3, url=.");
?>
