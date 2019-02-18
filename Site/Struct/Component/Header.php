<?php
printf("<div class='Header'>");
printf("<div>");

printf("<div class='HeaderTitle'>");

if(isset($_GET['MenuIndex']))
{
	switch($_GET['MenuIndex'])
	{
	  case 0:
	    printf("<h1>Companys</h1>");
	    break;

	  case 1:
	    printf("<h1>Countrys</h1>");
	    break;

	  case 2:
	    printf("<h1>Employees</h1>");
	    break;

	  case 3:
	    printf("<h1>Employee Positions</h1>");
	    break;

	  case 4:
	    printf("<h1>Jobs</h1>");
	    break;

	  case 5:
	    printf("<h1>Shareholders</h1>");
	    break;

	  case 6:
	    printf("<h1>Customers</h1>");
	    break;

	  case 7:
	    printf("<h1>Countys</h1>");
	    break;

	  case -1:
			printf("<h1>Error</h1>");
	    break;

	  default:
			printf("<h1>Home</h1>");
	    break;
	}
}
else
	printf("<h1>Home</h1>");

printf("</div>");

require_once("Struct/Module/Form/LoginForm.php");

printf("</div>");
printf("</div>");
?>
