<?php
function AccessFormRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT ACCESS_ID, ACCESS_title FROM VIEW_ACCESS WHERE VIEW_ACCESS.ACCESS_Level > 1;";

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

	$DBConn->CloseConn();

	unset($DBConn);
	unset($DBQuery);

	return $Result;
}

?>
