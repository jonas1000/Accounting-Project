<?php
function CountyGeneralRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT *
	FROM VIEW_COUNTY_GENERAL
	WHERE COU_AVAIL = 2
	AND VIEW_COUNTY_GENERAL.COU_ACCESS > ".($_SESSION['Access_ID'] - 1).";";

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

function CountyFormRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT COU_ID, COU_Title
	FROM VIEW_COUNTY_GENERAL
	WHERE COU_AVAIL = 2
	AND VIEW_COUNTY_GENERAL.COU_ACCESS > ".($_SESSION['Access_ID'] - 1).";";

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

?>
