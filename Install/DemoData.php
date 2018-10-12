<?php

/*----Data inserted in tables*/

$DBConn->autocommit(FALSE);

/*--------<INSERT DATA TO TABLE AVAILABLE>--------*/
$DBQuery="INSERT INTO AVAILABLE
(AVAILABLE_Deleted)
VALUES
(TRUE),
(FALSE);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 1.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 1 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE ACCESS_LEVEL>--------*/
$DBQuery="INSERT INTO ACCESS_LEVEL
(ACCESS_LEVEL_Title,
ACCESS_LEVEL_Clearance,
AVAILABLE_ID)
VALUES
(\"Admin\",1,2),
(\"CEO\",2,2),
(\"Employee\",3,2),
(\"Guest\",4,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 2.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 2 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE COUNTRY_DATA>--------*/
$DBQuery="INSERT INTO COUNTRY_DATA
(COUNTRY_DATA_Title,
COUNTRY_DATA_Tax,
COUNTRY_DATA_InterestRate,
COUNTRY_DATA_Date,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Greece\", 29.0000, 3.0000, \"2017-1-1\", 2 ,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 3.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 3 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE COUNTRY>--------*/
$DBQuery="INSERT INTO COUNTRY
(COUNTRY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1, 2, 2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 4.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 4 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE COMPANY_DATA>--------*/
$DBQuery="INSERT INTO COMPANY_DATA
(COMPANY_DATA_Title,
COMPANY_DATA_Date,
COUNTRY_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Demo Studio\",\"1995-1-1\",1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 5.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 5 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE COMPANY>--------*/
$DBQuery="INSERT INTO COMPANY
(COMPANY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 6.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 6 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE EMPLOYEE_POSITION>--------*/
$DBQuery="INSERT INTO EMPLOYEE_POSITION
(EMPLOYEE_POSITION_Title,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"CEO\",2,2),
(\"COO\",2,2),
(\"CFO\",2,2),
(\"CIO\",2,2),
(\"CBO\",2,2),
(\"CMO\",2,2),
(\"Video Editor\",2,2),
(\"Server Admin\",2,2),
(\"Game Developer\",2,2),
(\"Producer\",2,2),
(\"Manager\",2,2),
(\"Developer\",2,2),
(\"Game Designer\",2,2),
(\"Artist\",2,2),
(\"3D Artist\",2,2),
(\"Level Game Designer\",2,2),
(\"Marketeer\",2,2),
(\"Human Resources\",2,2),
(\"Programmer\",2,2),
(\"Software Enginner\",2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 7.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 7 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE EMPLOYEE_DATA>--------*/
$DBQuery="INSERT INTO EMPLOYEE_DATA
(EMPLOYEE_DATA_Salary,
EMPLOYEE_DATA_BDay,
EMPLOYEE_DATA_Name,
EMPLOYEE_DATA_PassWord,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(0,\"1970-1-1\",\"Μενέλαος Μπρούνζης\",\"" . password_hash("MenPass", PASSWORD_BCRYPT, ["cost" => 15]) . "\",3,2),
(0,\"1970-1-1\",\"Μιχαήλ Καλογιάννης\",\"" . password_hash("MixPass", PASSWORD_BCRYPT, ["cost" => 15]) . "\",2,2),
(0,\"1970-1-1\",\"Καληγούλα Κακογιάννης\",\"" . password_hash("calPass", PASSWORD_BCRYPT, ["cost" => 15]) . "\",1,2);";

//$DBQuery=mb_convert_encoding($DBQuery, "UTF-8", "auto");

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 8.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 8 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE EMPLOYEE>--------*/
$DBQuery="INSERT INTO EMPLOYEE
(EMPLOYEE_POSITION_ID,
EMPLOYEE_DATA_ID,
COMPANY_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(7,1,1,2,2),
(1,2,1,2,2),
(20,3,1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 9.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 9 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE SHAREHOLDER>--------*/
$DBQuery="INSERT INTO SHAREHOLDER
(EMPLOYEE_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(2,2,2),
(1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 10.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 10 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE JOB_INCOME>--------*/
$DBQuery="INSERT INTO JOB_INCOME
(JOB_INCOME_Price,
JOB_INCOME_PIA,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(3000,1200,2,2),
(5000,2000,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 11.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 11 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE JOB_OUTCOME>--------*/
$DBQuery="INSERT INTO JOB_OUTCOME
(JOB_OUTCOME_Expenses,
JOB_OUTCOME_Damage,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(500,1200,2,2),
(1000,700,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 12.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 12 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE JOB_DATA>--------*/
$DBQuery="INSERT INTO JOB_DATA
(JOB_DATA_Date,
JOB_INCOME_ID,
JOB_OUTCOME_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"1970-1-1\",1,1,2,2),
(\"1970-1-1\",2,2,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 13.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 13 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE JOB>--------*/
$DBQuery="INSERT INTO JOB
(JOB_Title,
JOB_DATA_ID,
COMPANY_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Video Editing\",1,1,2,2),
(\"Recording Studio\",2,1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 14.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 14 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE JOB_ASSIGMENT>--------*/
$DBQuery="INSERT INTO JOB_ASSIGMENT
(EMPLOYEE_ID,
JOB_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,1,2,2),
(2,2,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 14.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 14 - Error inserting data into table: " . $DBConn->error);

/*--------<INSERT DATA TO TABLE JOB_INCOME_TIME>--------*/
$DBQuery="INSERT INTO JOB_INCOME_TIME
(JOB_INCOME_TIME_PIT,
JOB_INCOME_TIME_Date,
JOB_INCOME_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(600,\"1970-2-1\",1,2,2),
(200,\"1970-3-1\",1,2,2),
(400,\"1970-2-1\",2,2,2),
(700,\"1970-3-1\",2,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");

	if(!$DBConn->commit())
		printf("<br>--ERROR 14.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 14 - Error inserting data into table: " . $DBConn->error);

?>
