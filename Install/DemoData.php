<?php
print("<br><h1>DEMO DATA</h1><br>");

/*--------<INSERT DATA TO TABLE COUNTRY_DATA>--------*/
$DBQuery="INSERT INTO ".$sPrefix."COUNTRY_DATA
(COUNTRY_DATA_Title,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Greece\", 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> COUNTRY_DATA", $DBInsSuccMsg);
else
	printf("<br>ERROR 1 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTRY>--------*/
$DBQuery="INSERT INTO ".$sPrefix."COUNTRY
(COUNTRY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1, 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> COUNTRY", $DBInsSuccMsg);
else
	printf("<br>ERROR 2 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTY_DATA>--------*/
$DBQuery="INSERT INTO ".$sPrefix."COUNTY_DATA
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
	printf("<br>%s -> COUNTY_DATA", $DBInsSuccMsg);
else
	printf("<br>ERROR 3 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COUNTY>--------*/
$DBQuery="INSERT INTO ".$sPrefix."COUNTY
(COUNTRY_ID,
COUNTY_DATA_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1, 1, 2, 2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> COUNTY", $DBInsSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COMPANY_DATA>--------*/
$DBQuery="INSERT INTO ".$sPrefix."COMPANY_DATA
(COMPANY_DATA_Title,
COMPANY_DATA_Date,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Demo Studio\",\"1995-1-1\",2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> COMPANY_DATA", $DBInsSuccMsg);
else
	printf("<br>ERROR 5 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE COMPANY>--------*/
$DBQuery="INSERT INTO ".$sPrefix."COMPANY
(COMPANY_DATA_ID,
COUNTY_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,1,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> COMPANY", $DBInsSuccMsg);
else
	printf("<br>ERROR 6 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE EMPLOYEE_POSITION>--------*/
$DBQuery="INSERT INTO ".$sPrefix."EMPLOYEE_POSITION
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
	printf("<br>%s -> EMPLOYEE_POSITION", $DBInsSuccMsg);
else
	printf("<br>ERROR 7 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE EMPLOYEE_DATA>--------*/
$DBQuery="INSERT INTO ".$sPrefix."EMPLOYEE_DATA
(EMPLOYEE_DATA_Salary,
EMPLOYEE_DATA_BDay,
EMPLOYEE_DATA_Name,
EMPLOYEE_DATA_Surname,
EMPLOYEE_DATA_Email,
EMPLOYEE_DATA_PassWord,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(0,\"1970-1-1\",\"Server\",\"Admin\",\"Adm@email.com\",\"" . password_hash("AdminPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",1,2),
(0,\"1970-1-1\",\"Μενέλαος\",\"Μπρούνζης\",\"Men@email.com\",\"" . password_hash("MenPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",2,2),
(0,\"1970-1-1\",\"Μιχαήλ\",\"Καλογιάννης\",\"Mix@email.com\",\"" . password_hash("MixPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",3,2),
(0,\"1970-1-1\",\"Καληγούλα\",\"Κακογιάννης\",\"kal@email.com\",\"" . password_hash("calPass", PASSWORD_BCRYPT, ["cost" => 10]) . "\",3,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> EMPLOYEE_DATA", $DBInsSuccMsg);
else
	printf("<br>ERROR 8 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE EMPLOYEE>--------*/
$DBQuery="INSERT INTO ".$sPrefix."EMPLOYEE
(EMPLOYEE_POSITION_ID,
EMPLOYEE_DATA_ID,
COMPANY_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(8,1,1,1,2),
(7,2,1,2,2),
(1,3,1,3,2),
(20,4,1,3,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> EMPLOYEE", $DBInsSuccMsg);
else
	printf("<br>ERROR 9 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE SHAREHOLDER>--------*/
$DBQuery="INSERT INTO ".$sPrefix."SHAREHOLDER
(EMPLOYEE_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(2,2,2),
(1,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> SHAREHOLDER", $DBInsSuccMsg);
else
	printf("<br>ERROR 10 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE CUSTOMER_DATA>--------*/
$DBQuery="INSERT INTO ".$sPrefix."CUSTOMER_DATA
(
	CUSTOMER_DATA_Name,
	CUSTOMER_DATA_Surname,
	CUSTOMER_DATA_VAT,
	CUSTOMER_DATA_PN,
	CUSTOMER_DATA_SN,
	CUSTOMER_DATA_Email,
	CUSTOMER_DATA_ADDR,
	AVAILABLE_ID,
	ACCESS_LEVEL_ID
)
VALUES
(\"John\",\"Marchal\",\"000000000\",\"6767676768\",\"2271023333\",\"JohnM@Email.com\",\"ST. Luther Street 32\", 2, 2),
(\"Maria\",\"Minerva\",\"000000001\",\"6767676767\",\"2271023333\",\"MariaM@Email.com\",\"ST. Luther Street 33\", 2, 2);";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> CUSTOMER_DATA", $DBInsSuccMsg);
else
	printf("<br>ERROR 11 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE CUSTOMER>--------*/
$DBQuery="INSERT INTO ".$sPrefix."CUSTOMER
(
	CUSTOMER_DATA_ID,
	AVAILABLE_ID,
	ACCESS_LEVEL_ID
)
VALUES
(1,2,2),
(2,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> CUSTOMER", $DBInsSuccMsg);
else
	printf("<br>ERROR 12 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_INCOME>--------*/
$DBQuery="INSERT INTO ".$sPrefix."JOB_INCOME
(JOB_INCOME_Price,
JOB_INCOME_PIA,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(3000,1200,2,2),
(5000,2000,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> JOB_INCOME", $DBInsSuccMsg);
else
	printf("<br>ERROR 13 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_OUTCOME>--------*/
$DBQuery="INSERT INTO ".$sPrefix."JOB_OUTCOME
(JOB_OUTCOME_Expenses,
JOB_OUTCOME_Damage,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(-500,-1200,2,2),
(-1000,-700,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> JOB_OUTCOME", $DBInsSuccMsg);
else
	printf("<br>ERROR 14 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_DATA>--------*/
$DBQuery="INSERT INTO ".$sPrefix."JOB_DATA
(JOB_DATA_Title,
JOB_DATA_Date,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(\"Video Editing\",\"1970-1-1\",2,2),
(\"Recording Studio\",\"1970-1-1\",2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> JOB_DATA", $DBInsSuccMsg);
else
	printf("<br>ERROR 15 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB>--------*/
$DBQuery="INSERT INTO ".$sPrefix."JOB
(JOB_DATA_ID,
COMPANY_ID,
JOB_INCOME_ID,
JOB_OUTCOME_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,1,1,1,2,2),
(2,1,2,2,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> JOB", $DBInsSuccMsg);
else
	printf("<br>ERROR 16 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_ASSIGMENT>--------*/
$DBQuery="INSERT INTO ".$sPrefix."JOB_ASSIGMENT
(EMPLOYEE_ID,
COUNTY_ID,
JOB_ID,
CUSTOMER_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(1,1,1,1,2,2),
(2,1,2,2,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> JOB_ASSIGMENT", $DBInsSuccMsg);
else
	printf("<br>ERROR 17 %s %s", $DBInsErrorMsg, $DBConn->GetError());

/*--------<INSERT DATA TO TABLE JOB_INCOME_TIME>--------*/
$DBQuery="INSERT INTO ".$sPrefix."JOB_INCOME_TIME
(JOB_INCOME_TIME_PIT,
JOB_INCOME_TIME_Date,
JOB_ID,
ACCESS_LEVEL_ID,
AVAILABLE_ID)
VALUES
(600,\"1970-2-1\",1,2,2),
(200,\"1970-3-1\",1,2,2),
(400,\"1970-2-1\",2,2,2),
(700,\"1970-3-1\",2,2,2);";

$DBConn->ExecQuery($DBQuery, TRUE);

if(!$DBConn->HasError())
	printf("<br>%s -> JOB_INCOME_TIME", $DBInsSuccMsg);
else
	printf("<br>ERROR 18 %s %s", $DBInsErrorMsg, $DBConn->GetError());

?>
