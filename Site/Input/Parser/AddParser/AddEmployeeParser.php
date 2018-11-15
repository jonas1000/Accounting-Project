<?php
require_once("../../../Data/ConnData/DBSessionToken.php");

session_start();

require("../../../DBConnManager.php");

switch(isset($_SESSION["Access_ID"]))
{
	case TRUE:
	{
		//get last query id
		$LastQueryID = EmployeeDataParser();

		//check if last id could be aquired
		switch($LastQueryID)
		{
			case TRUE:
			{
				EmployeeParser($LastQueryID);
				break;
			}
			case FALSE:
			{
				printf("couldn't get last id of query");
				break;
			}
			default:
				printf("unknown error detected");
		}

		break;
	}
	case FALSE:
	{
		printf("session access id not detected");
		break;
	}
	default:
		printf("unknown error detected");

	unset($LastQueryID);
}


function EmployeeDataParser()
{
	//database connection
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	//database Query
	$DBQuery = "INSERT INTO VIEW_EMPLOYEE_DATA(EMP_Name, EMP_PassWord, EMP_Email, EMP_Sal, EMP_BDay, EMP_ACCESS, EMP_AVAIL)
	VALUES(\"".$_POST['Name']."\", \"".password_hash($_POST['Pass'],PASSWORD_BCRYPT, ["cost" => 10])."\", \"".$_POST['Email']."\", ".$_POST['Salary'].", \"".$_POST['BDay']."\", ".$_POST['Access'].", 2);";

	$DBConn->ExecQuery($DBQuery, TRUE);

	$LastQueryID = $DBConn->GetLastQueryID();

	//detect and print if any error has been detected in query
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
			printf("unknown problem detected");
	}

	$DBConn->CloseConn();

	unset($DBConn);
	unset($DBQuery);

	return $LastQueryID;
}

function EmployeeParser($InLastID = null)
{
	switch(isset($InLastID))
	{
		case TRUE:
		{
			$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

			$DBQuery = "INSERT INTO VIEW_EMPLOYEE(EMP_POS_ID, EMP_COMP_ID, EMP_DATA_ID, EMP_ACCESS, EMP_AVAIL)
			VALUES(".$_POST['Position'].", ".$_POST['Company'].", ".$InLastID.", ".$_POST['Access'].", 2);";

			$DBConn->ExecQuery($DBQuery, TRUE);

			$LastQueryID = $DBConn->GetLastQueryID();

			//detect and print if any error has been detected in query
			switch(!$DBConn->HasError())
			{
				case TRUE:
				{
					if($DBConn->HasWarning())
						printf("warning detected: " . $DBConn->GetWarning());
					header("Location:../../../Form/AddForm/AddEmployeeForm.php");
					break;
				}
				case FALSE:
				{
					printf("Error: " . $DBConn->GetError());
					break;
				}
				default:
					printf("unknown error detected");
			}

			$DBConn->CloseConn();

			unset($DBConn);
			unset($DBQuery);

			return $LastQueryID;
			break;
		}
		case FALSE:
		{
			printf("Failed to get Last ID from previes query");
			break;
		}
		default:
			printf("Unknown error detected");
	}
}

?>
