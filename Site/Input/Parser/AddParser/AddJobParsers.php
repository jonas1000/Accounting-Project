<?php
require_once("../../Data/ConnData/DBSessionToken.php");

require("../../DBConnManager.php");

$DBConn = new DBConnManager($ServerName, $DBUserName, $DBPassWord);

$DBQuery = "INSERT INTO VIEW_JOB_OUTCOME(JOB_Exp, JOB_Dam, JOB_ACCESS, JOB_AVAIL) VALUES(".$_POST['Expenses'].", ".$_POST['Damage'].", ".$_POST['Access'].", ".$_POST['Hidden'].")";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
{
	printf("query executed");

	if($DBConn->HasWarning())
		printf("warning detected: " . $DBConn->GetWarning());
}
else
	printf("Error: " . $DBConn->GetError());

$DBQueryOutID = $DBConn->GetLastQueryID();

if($DBQueryOutID)
{
	$DBQuery = "INSERT INTO VIEW_JOB_INCOME(JOB_Price, JOB_PIA, JOB_ACCESS, JOB_AVAIL) VALUES(".$_POST['Price'].", ".$_POST['PIA'].", ".$_POST['Access2'].", ".$_POST['Hidden2'].")";

	$DBConn->ExecQuery($DBQuery, TRUE);

	if(!$DBConn->HasError())
	{
		printf("query executed");

		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	if($DBConn->GetLastQueryID())
	{
		$DBQuery = "INSERT INTO VIEW_JOB_DATA(JOB_INC_ID, JOB_OUT_ID, JOB_ACCESS, JOB_AVAIL) VALUES(".$DBConn->GetLastQueryInsID().", ".$DBQueryOutID.", ".$_POST['Access3'].", ".$_POST['Hidden3'].")";

		$DBConn->ExecQuery($DBQuery, TRUE);

		if(!$DBConn->HasError())
		{
			printf("query executed");

			if($DBConn->HasWarning())
				printf("warning detected: " . $DBConn->GetWarning());
		}
		else
			printf("Error: " . $DBConn->GetError());

		if($DBConn->GetLastQueryID())
		{
			$DBQuery = "INSERT INTO VIEW_JOB(JOB_DATA_ID, COMP_ID, JOB_Title, JOB_ACCESS, JOB_AVAIL) VALUES(".$DBConn->GetLastQueryInsID().", ".$_POST['Company'].", ".$_POST['Name'].", ".$_POST['Access4']." ,".$_POST['Hidden4'].")";

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
