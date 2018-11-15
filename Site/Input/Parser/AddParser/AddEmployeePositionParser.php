<?php
require_once("../../../Data/ConnData/DBSessionToken.php");

session_start();

switch(isset($_SESSION['Access_ID']))
{
	case TRUE:
	{
		if($_SESSION['Access_ID'] < 3)
		{
			require("../../../DBConnManager.php");

			$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

			$DBQuery = "INSERT INTO VIEW_EMPLOYEE_POSITION(EMP_Title, EMP_ACCESS, EMP_AVAIL) VALUES(\"".$_POST['Name']."\", ".$_POST['Access'].", 2)";

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
				default:
					printf("Unknown error detected");
			}

			$DBConn->closeConn();

			unset($DBConn);
			unset($DBQuery);
		}
		else
			printf("Restricted Access");

		break;
	}
	case FALSE:
	{
		printf("Failed to get token, abording");
		break;
	}
	default:
	{
		printf("Unknown error detected");
		break;
	}
}

header("Location:../../../Form/AddForm/AddEmployeePositionForm.php");

?>
