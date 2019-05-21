<?php
print("<div class='Header'>");
print("<div>");

print("<div class='HeaderTitle'>");

if(isset($_GET['MenuIndex']))
{
	switch($_GET['MenuIndex'])
	{
	  case 0:
	    print("<h1>Companys</h1>");
	    break;

	  case 1:
	    print("<h1>Countrys</h1>");
	    break;

	  case 2:
	    print("<h1>Employees</h1>");
	    break;

	  case 3:
	    print("<h1>Employee Positions</h1>");
	    break;

	  case 4:
	    print("<h1>Jobs</h1>");
	    break;

	  case 5:
	    print("<h1>Shareholders</h1>");
	    break;

	  case 6:
	    print("<h1>Customers</h1>");
	    break;

	  case 7:
	    print("<h1>Countys</h1>");
	    break;

	  case -1:
			print("<h1>Error</h1>");
	    break;

	  default:
			print("<h1>Home</h1>");
	    break;
	}
}
else
	print("<h1>Home</h1>");

print("</div>");

require_once("Struct/Module/Form/LoginForm.php");

print("</div>");
print("</div>");
?>
