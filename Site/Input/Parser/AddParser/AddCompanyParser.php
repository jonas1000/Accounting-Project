<?php
require_once("../../../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../../DBConnManager.php");

switch(isset($_SESSION['Access_ID']))
{
	case TRUE:
	{
		if($_SESSION['Access_ID'] < 3)
		{
			$LastQueryID = CompanyDataParser();

			switch($LastQueryID)
			{
				case TRUE:
				{
					CompanyParser($LastQueryID);
					break;
				}
				case FALSE:
				{
					printf("Failed to aquire last query id");
					break;
				}
				default:
					printf("Unknown error detected");
			}

		}
		else
			printf("Access denied");
		break;
	}
	case FALSE:
	{
		printf("session access not detected");
		break;
	}
	default:
		printf("unknown problem detected");

	unset($LastQueryID);
}

function CompanyDataParser()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "INSERT INTO VIEW_COMPANY_DATA(COU_ID, COMP_Title, COMP_Date, COMP_ACCESS, COMP_AVAIL)
	VALUES(\"".$_POST['Country']."\", \"".$_POST['Name']."\", \"".$_POST['Date']."\", ".$_POST['Access'].", 2)";

	$DBConn->ExecQuery($DBQuery, TRUE);

	$LastQueryID = $DBConn->GetLastQueryID();

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
			printf("unknown error detected");
	}

	$DBConn->CloseConn();

	unset($DBConn);
	unset($DBQuery);

	return $LastQueryID;
}

function CompanyParser($InLastQueryID)
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "INSERT INTO VIEW_COMPANY(COMP_DATA_ID, COMP_ACCESS, COMP_AVAIL)
	VALUES(".$InLastQueryID.", ".$_POST['Access'].", 2);";

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
			printf("unknown error detected");

		$DBConn->closeConn();
	}

	unset($DBConn);
	unset($DBQuery);
}

?>
