<?php
require("../../DatabaseConData.php");
require("../../DBConnManager.php");

$DBConn = new DBConnManager($ServerName, $DBUserName, $DBPassWord);

$DBQuery = "INSERT INTO VIEW_EMPLOYEE_DATA(EMP_Name, EMP_PassWord, EMP_Sal, EMP_BDay, EMP_ACCESS, EMP_AVAIL) VALUES(".$_POST['Name'].", ".$_POST['Pass'].", ".$_POST['Salary'].", ".$_POST['BDay'].", ".$_POST['Access'].", ".$_POST['Hidden'].")";

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
	$DBQuery = "INSERT INTO VIEW_EMPLOYEE(EMP_POS_ID, EMP_DATA_ID, EMP_ACCESS, EMP_AVAIL) VALUES(".$_POST['Position'].", ".$DBConn->GetLastQueryInsID().", ".$_POST['Access2'].", ".$_POST['Hidden2'].")";

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
	printf("Error: Failed to get last id.");

$DBConn->closeConn();

?>
