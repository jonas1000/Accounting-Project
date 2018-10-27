<?php
require("../../DatabaseConData.php");
require("../../DBConnManager.php");

$DBConn = new DBConnManager($ServerName, $DBUserName, $DBPassWord);

$DBQuery = "INSERT INTO VIEW_COUNTRY_DATA(COU_title, COU_Tax, COU_IR, COU_ACCESS, COU_AVAIL) VALUES(".$_POST['Name'].", ".$_POST['Tax'].", ".$_POST['InterestRate'].", ".$_POST['Access'].", "$_POST['Hidden']")";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
{
	printf("query executed");

	if($DBConn->HasWarning())
		printf("warning detected: " . $DBConn->GetWarning());
}
else
	printf("Error: " . $DBConn->GetError());

if($DBConn->GetLastQueryInsID())
{
	$DBQuery = "INSERT INTO VIEW_COUNTRY(COU_DATA_ID, COU_ACCESS, COU_AVAIL) VALUES(".$DBConn->GetLastQueryInsID().", ".$_POST['Access2'].", "$_POST['Hidden2']")";

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
	printf("Error: Failed to get the id of last query");

$DBConn->closeConn();

?>
