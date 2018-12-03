<?php
function JobGeneralRetriever()
{
	$DBConn = new DBConnManager($_SESSION['ServerName'], $_SESSION['DBUserName'], $_SESSION['DBPassWord']);

	$DBQuery = "SELECT *
	FROM VIEW_JOB_GENERAL
	WHERE JOB_AVAIL = 2;";

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
