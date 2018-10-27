<?php
require("../DBConnData.php");
require("../DBConnManager.php");

function EmployeePositionRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT * FROM VIEW_EMPLOYEE_POSITION WHERE EMP_AVAIL = 2";

	$DBConn->ExecQuery($DBQuery, FALSE);

	$Result = $DBConn->GetResult();

	if(!$DBConn->HasError())
	{
		printf("query executed");

		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$DBConn->closeConn();

	return $Result;
}

?>
