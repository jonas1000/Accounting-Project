<?php
print("<div class='Footer'>");

print("<div>");
print("<h1>Footer</h1>");
if(isset($_SESSION['AppVersion']))
	printf("<p>Version:%s</p>", $_SESSION['AppVersion']);
print("</div>");

print("</div>");
?>
