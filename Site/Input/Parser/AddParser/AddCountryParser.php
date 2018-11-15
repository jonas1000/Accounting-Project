<?php
require_once("../../../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../../DBConnManager.php");

switch(isset($_SESSION['Access_ID']))
{
	case TRUE:
	{
		printf("test10");
		if($_SESSION["Access_ID"] < 3)
		{
			$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

			$DBQuery = "INSERT INTO VIEW_COUNTRY_DATA(COU_title, COU_ACCESS, COU_AVAIL)
			VALUES(\"".$_POST['Name']."\", ".$_POST['Access'].", 2)";

			$DBConn->ExecQuery($DBQuery, TRUE);
			printf("test");
			switch(!$DBConn->HasError())
			{
				case TRUE:
				{
					if($DBConn->HasWarning())
						printf("warning detected: " . $DBConn->GetWarning());

					printf("test1");

					break;
				}
				case FALSE:
				{
					printf("Error: " . $DBConn->GetError());

					printf("test2");
					break;
				}
				default:
					printf("unknown problem detected");
			}

			switch($DBConn->GetLastQueryID())
			{
				case TRUE:
				{
					$DBQuery = "INSERT INTO VIEW_COUNTRY(COU_DATA_ID, COU_ACCESS, COU_AVAIL)
					VALUES(".$DBConn->GetLastQueryID().", ".$_POST['Access'].", 2)";

					$DBConn->ExecQuery($DBQuery, TRUE);

					switch(!$DBConn->HasError())
					{
						case TRUE:
						{
							if($DBConn->HasWarning())
								printf("warning detected: " . $DBConn->GetWarning());

							break;
						}
						case FALSE:
						{
							printf("Error: " . $DBConn->GetError());
							break;
						}
					}

					break;
				}
				case FALSE:
				{
					printf("Error: Failed to get the id of last query");
					break;
				}
				default:
					printf("Unknown problem detected");
			}

			$DBConn->closeConn();
			unset($DBConn);
			unset($DBQuery);
		}
		break;
	}
	case FALSE:
	{
		printf("session access id not detected");
		break;
	}
	default:
		printf("Unknown problem detected");
}

?>
