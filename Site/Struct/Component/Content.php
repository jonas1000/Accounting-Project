<?php
require("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");

printf("<div class='Content'>");

//If $_GET['MenuIndex'] is set
if(isset($_GET["MenuIndex"]))
{
	//Get the index and load the required menu item
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
		case 6:
		{
			require_once("Struct/Module/Overview/CustomerOverview.php");
			break;
		}
		case 7:
		{
			require_once("Struct/Module/Overview/CountyOverview.php");
			break;
		}
		case -1:
		{
			require_once("Struct/Module/AccessError.php");
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
