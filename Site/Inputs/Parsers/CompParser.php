<?php

header("Content-Type: text/html; charset='utf-8'");

require("../../DatabaseConData.php");
require("../../DBConnManager.php");

$DBConn = new DBConnManager($ServerName, $DBUserName, $DBPassWord);

$DBQuery = "INSERT INTO VIEW_COMPANY_DATA(COU_ID, COMP_Title, COMP_Date, COMP_ACCESS, COMP_AVAIL) VALUES(".$_POST['Country'].", ".$_POST['Name'].", ".$_POST['Date'].", ".$_POST['Access'].", ".$_POST['Hidden'].")";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
{
	printf("query executed");

	if($DBConn->HasWarning())
		printf("warning detected: " . $DBConn->GetWarning());
}
else
{
	printf("Error: " . $DBConn->GetError());
}

$DBQuery = "INSERT INTO VIEW_COMPANY(COU_DATA_ID, COMP_ACCESS, COMP_AVAIL) VALUES(".$_POST['Data'].", ".$_POST['Data_Access'].", ".$_POST['Data_Hidden'].")";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
{
	printf("query executed");

	if($DBConn->HasWarning())
		printf("warning detected: " . $DBConn->GetWarning());
}
else
{
	printf("Error: " . $DBConn->GetError());
}

$DBConn->closeConn();

?>
