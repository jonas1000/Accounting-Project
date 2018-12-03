<?php

printf("<div class='Content'>");

//If $_GET['MenuIndex'] is set
switch(isset($_GET["MenuIndex"]))
{
	case TRUE:
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
			default:
			{
				require_once("Struct/Module/Home.php");
			}
		}
		break;
	}

	case FALSE:
	{
		require_once("Struct/Module/Home.php");
		break;
	}

	//an undefined error
	default:
	{
		printf("A undefined error has been detected");
	}
}

printf("</div>");

?>
