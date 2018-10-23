<?php

header("Content-Type: text/html; charset='utf-8'");

require("DBConnData.php");
require("DBConnManager.php");

function JobGeneralRetriever()
{
	$DBConn = new DBConnManager($_SERVER['ServerName'], $_SERVER['DBUserName'], $_SERVER['DBPassWord']);

	$DBQuery = "SELECT * FROM VIEW_JOB_GENERAL WHERE JOB_AVAIL = 2;";

	$DBConn->ExecQuery($DBQuery, FALSE);

	$Result = $DBConn->GetResult();

	if(!$DBConn->HasError())
	{
		printf("Result array received");

		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$DBConn->closeConn();

	return $Result;
}

?>
