<?php
function EmployeeGeneralRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT *
	FROM VIEW_EMPLOYEE_GENERAL
	WHERE EMP_AVAIL = 2
	AND VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($_SESSION['Access_ID'] - 1).";";

	$DBConn->ExecQuery($DBQuery, FALSE);

	$Result = $DBConn->GetResult();

	if(!$DBConn->HasError())
	{
		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$DBConn->closeConn();

	unset($DBConn);
	unset($DBQuery);

	return $Result;
}

function EmployeePositionRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT *
	FROM VIEW_EMPLOYEE_POSITION
	WHERE EMP_AVAIL = 2
	AND VIEW_EMPLOYEE_POSITION.EMP_ACCESS > ".($_SESSION['Access_ID'] - 1).";";

	$DBConn->ExecQuery($DBQuery, FALSE);

	$Result = $DBConn->GetResult();

	if(!$DBConn->HasError())
	{
		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$DBConn->closeConn();

	unset($DBConn);
	unset($DBQuery);

	return $Result;
}

function EmployeeFormRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT EMP_ID, EMP_Name
	FROM VIEW_EMPLOYEE_GENERAL
	WHERE VIEW_EMPLOYEE_GENERAL.EMP_AVAIL = 2
	AND VIEW_EMPLOYEE_GENERAL.EMP_ACCESS > ".($_SESSION['Access_ID'] - 1).";";

	$DBConn->ExecQuery($DBQuery, FALSE);

	$Result = $DBConn->GetResult();

	if(!$DBConn->HasError())
	{
		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$DBConn->CloseConn();

	unset($DBConn);
	unset($DBQuery);

	return $Result;
}

function EmployeePosFormRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT EMP_ID, EMP_Title
	FROM VIEW_EMPLOYEE_POSITION
	WHERE VIEW_EMPLOYEE_POSITION.EMP_AVAIL = 2
	AND VIEW_EMPLOYEE_POSITION.EMP_ACCESS > ".($_SESSION['Access_ID'] - 1).";";

	$DBConn->ExecQuery($DBQuery, FALSE);

	$Result = $DBConn->GetResult();

	if(!$DBConn->HasError())
	{
		if($DBConn->HasWarning())
			printf("warning detected: " . $DBConn->GetWarning());
	}
	else
		printf("Error: " . $DBConn->GetError());

	$DBConn->CloseConn();

	unset($DBConn);
	unset($DBQuery);

	return $Result;
}

?>
