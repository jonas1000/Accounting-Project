<?php
print("<div>");
print("<img src='../images/Warning.png'");
print("<h3>Access is denied</h3>");
print("<p>redirecting in 3 seconds</p>");
print("</div>");

header("refresh: 3, url=.");
?>
