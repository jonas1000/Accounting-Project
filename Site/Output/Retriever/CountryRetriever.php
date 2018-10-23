<?php

header("Content-Type: text/html; charset='utf-8'");

require("../../DBConData.php");
require("../../DBConnManager.php");


function CountryGeneralRetriever()
{
	$DBConn = new DBConnManager($ServerName, $DBUserName, $DBPassWord);

	$DBQuery = "SELECT * FROM VIEW_COUNTRY_GENERAL WHERE COU_AVAIL = 2";

	$Result = $DBConn->ExecQuery($DBQuery, FALSE);

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
