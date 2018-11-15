<?php
require_once("../../../Data/ConnData/DBSessionToken.php");

session_start();

require("../../../DBConnManager.php");

$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

$DBQuery = "INSERT INTO VIEW_JOB_OUTCOME(JOB_Exp, JOB_Dam, JOB_ACCESS, JOB_AVAIL) VALUES(".$_POST['Expenses'].", ".$_POST['Damage'].", ".$_POST['Access'].", 2)";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
{
	printf("query executed");

	if($DBConn->HasWarning())
		printf("warning detected: " . $DBConn->GetWarning());
}
else
	printf("Error: " . $DBConn->GetError());

$LastQueryOutcomeID = $DBConn->GetLastQueryID();

if($LastQueryOutcomeID)
{
	$DBQuery = "INSERT INTO VIEW_JOB_INCOME(JOB_Price, JOB_PIA, JOB_ACCESS, JOB_AVAIL) VALUES(".$_POST['Price'].", ".$_POST['PIA'].", ".$_POST['Access'].", 2)";

	$DBConn->ExecQuery($DBQuery, TRUE);

	if(!$DBConn->HasError())
	{
		printf("query executed");

		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$LastQuery = $DBConn->GetLastQueryID();

	if($LastQuery)
	{
		$DBQuery = "INSERT INTO VIEW_JOB_DATA(JOB_INC_ID, JOB_OUT_ID, JOB_Title, JOB_Date, JOB_ACCESS, JOB_AVAIL) VALUES(".$LastQuery.", ".$LastQueryOutcomeID.", \"".$_POST['Name']."\", \"".$_POST['Date']."\" , ".$_POST['Access'].", 2)";

		$DBConn->ExecQuery($DBQuery, TRUE);

		if(!$DBConn->HasError())
		{
			printf("query executed");

			if($DBConn->HasWarning())
				printf("warning detected: " . $DBConn->GetWarning());
		}
		else
			printf("Error: " . $DBConn->GetError());

		$LastQuery = $DBConn->GetLastQueryID();

		if($LastQuery)
		{
			$DBQuery = "INSERT INTO VIEW_JOB(JOB_DATA_ID, COMP_ID, JOB_ACCESS, JOB_AVAIL) VALUES(".$LastQuery.", ".$_POST['Company'].", ".$_POST['Access']." , 2)";

			$DBConn->ExecQuery($DBQuery, TRUE);

			if(!$DBConn->HasError())
			{
				printf("query executed");

				if($DBConn->HasWarning())
					printf("warning detected: " . $DBConn->GetWarning());
			}
			else
				printf("Error: " . $DBConn->GetError());
		}
		else
			printf("Error 3: Failed to get id from last query");
	}
	else
		printf("Error 2: Failed to get id from last query");
}
else
	printf("Error 1: Failed to get id from last query");

$DBConn->closeConn();

unset($DBConn);
unset($DBQuery);

?>
