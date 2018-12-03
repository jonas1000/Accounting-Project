<?php

printf("<div class='Content'>");

if(isset($_GET["MenuIndex"]))
{
	switch($_GET["MenuIndex"])
	{
		case 0:
		{
			require_once("Struct/Module/Overview/CompanyOverview.php");
			break;
		}
		case 1:
		{
			require_once("Struct/Module/Overview/CountryOverview.php");
			break;
		}
		case 2:
		{
			require_once("Struct/Module/Overview/EmployeeOverview.php");
			break;
		}
		case 3:
		{
			require_once("Struct/Module/Overview/EmployeePositionOverview.php");
			break;
		}
		case 4:
		{
			require_once("Struct/Module/Overview/JobOverview.php");
			break;
		}
		case 5:
		{
			require_once("Struct/Module/Overview/ShareholderOverview.php");
			break;
		}
		default:
		{
			require_once("Struct/Module/Home.php");
		}
	}
}
else
	require_once("Struct/Module/Home.php");

printf("</div>");

?>
