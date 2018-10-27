<?php
require("../Site/Data/HeaderData/HeaderData.php");

require("../Site/DebugLogComMessage/DBErrorMsg.php");
require("../Site/DebugLogComMessage/DBSuccMsg.php");

/*----Data inserted in tables*/

/*--------<INSERT DATA TO TABLE AVAILABLE>--------*/
$DBQuery="INSERT INTO AVAILABLE
(AVAILABLE_Deleted)
VALUES
(TRUE),
(FALSE);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 1 " . $DBInsErrorMsg . $DBConn->GetError());

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

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 2 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTRY_DATA>--------*/
$DBQuery="INSERT INTO COUNTRY_DATA
(COUNTRY_DATA_Title,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Greece\", 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 3 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTRY>--------*/
$DBQuery="INSERT INTO COUNTRY
(COUNTRY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1, 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 4 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTY_DATA>--------*/
$DBQuery="INSERT INTO COUNTY_DATA
(COUNTY_DATA_Title,
COUNTY_DATA_Tax,
COUNTY_DATA_InterestRate,
COUNTY_DATA_Date,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Chios\", 7, 2, \"2018-1-1\", 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 5 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTY>--------*/
$DBQuery="INSERT INTO COUNTY
(COUNTRY_ID,
COUNTY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1, 1, 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 6 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COMPANY_DATA>--------*/
$DBQuery="INSERT INTO COMPANY_DATA
(COMPANY_DATA_Title,
COMPANY_DATA_Date,
COUNTY_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Demo Studio\",\"1995-1-1\",1,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 7 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COMPANY>--------*/
$DBQuery="INSERT INTO COMPANY
(COMPANY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 8 " . $DBInsErrorMsg . $DBConn->GetError());

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

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 9 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE EMPLOYEE_DATA>--------*/
$DBQuery="INSERT INTO EMPLOYEE_DATA
(EMPLOYEE_DATA_Salary,
EMPLOYEE_DATA_BDay,
EMPLOYEE_DATA_Name,
EMPLOYEE_DATA_Email,
EMPLOYEE_DATA_PassWord,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(0,\"1970-1-1\",\"Μενέλαος Μπρούνζης\",\"Men@email.com\",\"" . password_hash("MenPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",3,2),
(0,\"1970-1-1\",\"Μιχαήλ Καλογιάννης\",\"Mix@email.com\",\"" . password_hash("MixPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",2,2),
(0,\"1970-1-1\",\"Καληγούλα Κακογιάννης\",\"kal@email.com\",\"" . password_hash("calPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",1,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 10 " . $DBInsErrorMsg . $DBConn->GetError());

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

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 11 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE SHAREHOLDER>--------*/
$DBQuery="INSERT INTO SHAREHOLDER
(EMPLOYEE_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(2,2,2),
(1,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 12 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_INCOME>--------*/
$DBQuery="INSERT INTO JOB_INCOME
(JOB_INCOME_Price,
JOB_INCOME_PIA,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(3000,1200,2,2),
(5000,2000,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 13 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_OUTCOME>--------*/
$DBQuery="INSERT INTO JOB_OUTCOME
(JOB_OUTCOME_Expenses,
JOB_OUTCOME_Damage,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(500,1200,2,2),
(1000,700,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 14 " . $DBInsErrorMsg . $DBConn->GetError());

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

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 15 " . $DBInsErrorMsg . $DBConn->GetError());

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

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 16 " . $DBInsErrorMsg . $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_ASSIGMENT>--------*/
$DBQuery="INSERT INTO JOB_ASSIGMENT
(EMPLOYEE_ID,
COUNTY_ID,
JOB_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,1,1,2,2),
(2,1,2,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 17 " . $DBInsErrorMsg . $DBConn->GetError());

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

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>" . $DBInsSuccMsg);
else
	printf("<br>ERROR 18 " . $DBInsErrorMsg . $DBConn->GetError());

?>
