<?php
require("../../DatabaseConData.php");
require("../../DBConnManager.php");

$DBConn = new DBConnManager($ServerName, $DBUserName, $DBPassWord);

$DBQuery = "INSERT INTO VIEW_SHAREHOLDER(EMP_ID, SHARE_ACCESS, SHARE_AVAIL) VALUES(".$_POST['Employee'].", ".$_POST['Access'].", ".$_POST['hidden'].")";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
{
	printf("query executed");

	if($DBConn->HasWarning())
		printf("warning detected: " . $DBConn->GetWarning());
}
else
	printf("Error: " . $DBConn->GetError());

$DBConn->closeConn();

?>
