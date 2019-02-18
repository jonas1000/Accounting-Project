<?php
/*----Create view tables*/

printf("<br><h1>VIEW TABLE</h1><br>");

/*--------<VIEW EMPLOYEE TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_EMPLOYEE AS
SELECT
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_ID AS EMP_ID,
".$DBConn->GetPrefix()."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE.ACCESS_LEVEL_ID AS EMP_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_CDate AS EMP_CDATE,
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$DBConn->GetPrefix()."EMPLOYEE.COMPANY_ID AS COMP_ID,
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_DATA_ID AS EMP_DATA_ID
FROM
".$DBConn->GetPrefix()."EMPLOYEE;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_EMPLOYEE");
else
	printf("<br>ERROR 1 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_EMPLOYEE_LOGIN AS
SELECT
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_ID AS EMP_ID,
".$DBConn->GetPrefix()."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE.ACCESS_LEVEL_ID AS EMP_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_CDate AS EMP_CDATE,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_PassWord AS EMP_DATA_PASS,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME
FROM
".$DBConn->GetPrefix()."EMPLOYEE,
".$DBConn->GetPrefix()."EMPLOYEE_DATA
WHERE
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_DATA_ID = ".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_ID;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_EMPLOYEE_LOGIN");
else
	printf("<br>ERROR 2 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION AS
SELECT
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_Title AS EMP_POS_TITLE,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_CDate AS EMP_POS_CDATE,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.ACCESS_LEVEL_ID AS EMP_POS_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL
FROM
".$DBConn->GetPrefix()."EMPLOYEE_POSITION;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_EMPLOYEE_POSITION");
else
	printf("<br>ERROR 3 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_EMPLOYEE_DATA AS
SELECT
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_ID AS EMP_DATA_ID,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Salary AS EMP_DATA_SAL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_PassWord AS EMP_DATA_PASS,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_BDay AS EMP_DATA_BDAY,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_PN AS EMP_DATA_PN,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_SN AS EMP_DATA_SN,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_CDate AS EMP_DATA_CDATE,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.ACCESS_LEVEL_ID AS EMP_DATA_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL
FROM
".$DBConn->GetPrefix()."EMPLOYEE_DATA;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_EMPLOYEE_DATA");
else
	printf("<br>ERROR 4 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_EMPLOYEE_GENERAL AS
SELECT
".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_ID AS EMP_ID,
".$DBConn->GetPrefix()."EMPLOYEE.ACCESS_LEVEL_ID AS EMP_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.ACCESS_LEVEL_ID AS EMP_DATA_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Salary AS EMP_DATA_SAL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_PassWord AS EMP_DATA_PASS,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_BDay AS EMP_DATA_BDAY,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_PN AS EMP_DATA_PN,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_SN AS EMP_DATA_SN,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.ACCESS_LEVEL_ID AS EMP_POS_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_Title AS EMP_POS_TITLE
FROM
".$DBConn->GetPrefix()."EMPLOYEE,
".$DBConn->GetPrefix()."EMPLOYEE_DATA,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION
WHERE
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_ID = ".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_POSITION_ID
AND ".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_ID = ".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_DATA_ID;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_EMPLOYEE_GENERAL");
else
	printf("<br>ERROR 5 " . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW COUNTRY TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COUNTRY AS
SELECT
".$DBConn->GetPrefix()."COUNTRY.COUNTRY_ID AS COUN_ID,
".$DBConn->GetPrefix()."COUNTRY.ACCESS_LEVEL_ID AS COUN_ACCESS,
".$DBConn->GetPrefix()."COUNTRY.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$DBConn->GetPrefix()."COUNTRY.AVAILABLE_ID AS COUN_AVAIL,
".$DBConn->GetPrefix()."COUNTRY.COUNTRY_CDate AS COUN_CDATE
FROM
".$DBConn->GetPrefix()."COUNTRY;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COUNTRY");
else
	printf("<br>ERROR 6 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COUNTRY_DATA AS
SELECT
".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$DBConn->GetPrefix()."COUNTRY_DATA.ACCESS_LEVEL_ID AS COUN_DATA_ACCESS,
".$DBConn->GetPrefix()."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL,
".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_Title AS COUN_DATA_TITLE,
".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_CDate AS COUN_DATA_CDATE
FROM
".$DBConn->GetPrefix()."COUNTRY_DATA;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COUNTRY_DATA");
else
	printf("<br>ERROR 7 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COUNTRY_GENERAL AS
SELECT
".$DBConn->GetPrefix()."COUNTRY.COUNTRY_ID AS COUN_ID,
".$DBConn->GetPrefix()."COUNTRY.ACCESS_LEVEL_ID AS COUN_ACCESS,
".$DBConn->GetPrefix()."COUNTRY.AVAILABLE_ID AS COUN_AVAIL,
".$DBConn->GetPrefix()."COUNTRY.COUNTRY_CDate AS COUN_CDATE,
".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$DBConn->GetPrefix()."COUNTRY_DATA.ACCESS_LEVEL_ID AS COUN_DATA_ACCESS,
".$DBConn->GetPrefix()."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL,
".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_Title COUN_DATA_TITLE
FROM
".$DBConn->GetPrefix()."COUNTRY,
".$DBConn->GetPrefix()."COUNTRY_DATA
WHERE
".$DBConn->GetPrefix()."COUNTRY.COUNTRY_DATA_ID = ".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_ID;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COUNTRY_GENERAL");
else
	printf("<br>ERROR 8 " . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW COUNTY TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COUNTY AS
SELECT
".$DBConn->GetPrefix()."COUNTY.COUNTY_ID AS COU_ID,
".$DBConn->GetPrefix()."COUNTY.COUNTRY_ID AS COUN_ID,
".$DBConn->GetPrefix()."COUNTY.ACCESS_LEVEL_ID AS COU_ACCESS,
".$DBConn->GetPrefix()."COUNTY.COUNTY_DATA_ID AS COU_DATA_ID,
".$DBConn->GetPrefix()."COUNTY.AVAILABLE_ID AS COU_AVAIL,
".$DBConn->GetPrefix()."COUNTY.COUNTY_CDate AS COU_CDATE
FROM
".$DBConn->GetPrefix()."COUNTY;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COUNTY");
else
	printf("<br>ERROR 9 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COUNTY_DATA AS
SELECT
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_ID AS COU_DATA_ID,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Date AS COU_DATA_DATE,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_CDate AS COU_DATA_CDATE,
".$DBConn->GetPrefix()."COUNTY_DATA.ACCESS_LEVEL_ID AS COU_DATA_ACCESS,
".$DBConn->GetPrefix()."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL
FROM
".$DBConn->GetPrefix()."COUNTY_DATA;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COUNTY_DATA");
else
	printf("<br>ERROR 10 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COUNTY_GENERAL AS
SELECT
".$DBConn->GetPrefix()."COUNTY.COUNTY_ID AS COU_ID,
".$DBConn->GetPrefix()."COUNTY.COUNTRY_ID AS COUN_ID,
".$DBConn->GetPrefix()."COUNTY.ACCESS_LEVEL_ID AS COU_ACCESS,
".$DBConn->GetPrefix()."COUNTY.AVAILABLE_ID AS COU_AVAIL,
".$DBConn->GetPrefix()."COUNTY.COUNTY_CDate AS COU_CDATE,
".$DBConn->GetPrefix()."COUNTY_DATA.ACCESS_LEVEL_ID AS COU_DATA_ACCESS,
".$DBConn->GetPrefix()."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Date AS COU_DATA_DATE
FROM
".$DBConn->GetPrefix()."COUNTY,
".$DBConn->GetPrefix()."COUNTY_DATA
WHERE
".$DBConn->GetPrefix()."COUNTY.COUNTY_DATA_ID = ".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_ID;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COUNTY_GENERAL");
else
	printf("<br>ERROR 11 " . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW JOB TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB_ASSIGMENT AS
SELECT
".$DBConn->GetPrefix()."JOB_ASSIGMENT.JOB_ASSIGMENT_ID AS JOB_ASS_ID,
".$DBConn->GetPrefix()."JOB_ASSIGMENT.ACCESS_LEVEL_ID AS JOB_ASS_ACCESS,
".$DBConn->GetPrefix()."JOB_ASSIGMENT.CUSTOMER_ID AS CUST_ID,
".$DBConn->GetPrefix()."JOB_ASSIGMENT.EMPLOYEE_ID AS EMP_ID,
".$DBConn->GetPrefix()."JOB_ASSIGMENT.JOB_ID AS JOB_ID,
".$DBConn->GetPrefix()."JOB_ASSIGMENT.AVAILABLE_ID AS JOB_ASS_AVAIL,
".$DBConn->GetPrefix()."JOB_ASSIGMENT.JOB_ASSIGMENT_CDate AS JOB_ASS_CDATE
FROM
".$DBConn->GetPrefix()."JOB_ASSIGMENT;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB_ASSIGMENT");
else
	printf("<br>ERROR 12 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB AS
SELECT
".$DBConn->GetPrefix()."JOB.JOB_ID AS JOB_ID,
".$DBConn->GetPrefix()."JOB.JOB_DATA_ID AS JOB_DATA_ID,
".$DBConn->GetPrefix()."JOB.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$DBConn->GetPrefix()."JOB.JOB_INCOME_ID AS JOB_INC_ID,
".$DBConn->GetPrefix()."JOB.COMPANY_ID AS COMP_ID,
".$DBConn->GetPrefix()."JOB.AVAILABLE_ID AS JOB_AVAIL,
".$DBConn->GetPrefix()."JOB.ACCESS_LEVEL_ID AS JOB_ACCESS,
".$DBConn->GetPrefix()."JOB.JOB_CDate AS JOB_CDATE
FROM
".$DBConn->GetPrefix()."JOB;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB");
else
	printf("<br>ERROR 13 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB_DATA AS
SELECT
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_ID AS JOB_DATA_ID,
".$DBConn->GetPrefix()."JOB_DATA.ACCESS_LEVEL_ID AS JOB_DATA_ACCESS,
".$DBConn->GetPrefix()."JOB_DATA.AVAILABLE_ID AS JOB_DATA_AVAIL,
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_Title AS JOB_DATA_TITLE,
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_Date AS JOB_DATA_DATE,
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_CDate AS JOB_DATA_CDATE
FROM
".$DBConn->GetPrefix()."JOB_DATA;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB_DATA");
else
	printf("<br>ERROR 14 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB_INCOME AS
SELECT
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_ID AS JOB_INC_ID,
".$DBConn->GetPrefix()."JOB_INCOME.ACCESS_LEVEL_ID AS JOB_INC_ACCESS,
".$DBConn->GetPrefix()."JOB_INCOME.AVAILABLE_ID AS JOB_INC_AVAIL,
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_Price AS JOB_INC_PRICE,
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_PIA AS JOB_INC_PIA,
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_CDate AS JOB_INC_CDate
FROM
".$DBConn->GetPrefix()."JOB_INCOME;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB_INCOME");
else
	printf("<br>ERROR 15 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB_OUTCOME AS
SELECT
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$DBConn->GetPrefix()."JOB_OUTCOME.ACCESS_LEVEL_ID AS JOB_OUT_ACCESS,
".$DBConn->GetPrefix()."JOB_OUTCOME.AVAILABLE_ID AS JOB_OUT_AVAIL,
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_Expenses AS JOB_OUT_EXP,
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_Damage AS JOB_OUT_DAM,
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_CDate AS JOB_OUT_CDATE
FROM
".$DBConn->GetPrefix()."JOB_OUTCOME;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB_OUTCOME");
else
	printf("<br>ERROR 16 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB_INCOME_TIME AS
SELECT
".$DBConn->GetPrefix()."JOB_INCOME_TIME.JOB_INCOME_TIME_ID AS JOB_PIT_ID,
".$DBConn->GetPrefix()."JOB_INCOME_TIME.ACCESS_LEVEL_ID AS JOB_PIT_ACCESS,
".$DBConn->GetPrefix()."JOB_INCOME_TIME.JOB_ID AS JOB_ID,
".$DBConn->GetPrefix()."JOB_INCOME_TIME.AVAILABLE_ID AS JOB_PIT_AVAIL,
".$DBConn->GetPrefix()."JOB_INCOME_TIME.JOB_INCOME_TIME_PIT AS JOB_PIT,
".$DBConn->GetPrefix()."JOB_INCOME_TIME.JOB_INCOME_TIME_Date AS JOB_PIT_DATE,
".$DBConn->GetPrefix()."JOB_INCOME_TIME.JOB_INCOME_TIME_CDate AS JOB_PIT_CDATE
FROM
".$DBConn->GetPrefix()."JOB_INCOME_TIME;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB_INCOME_TIME");
else
	printf("<br>ERROR 17 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_JOB_GENERAL AS
SELECT
".$DBConn->GetPrefix()."JOB.JOB_ID AS JOB_ID,
".$DBConn->GetPrefix()."JOB.ACCESS_LEVEL_ID AS JOB_ACCESS,
".$DBConn->GetPrefix()."JOB.AVAILABLE_ID AS JOB_AVAIL,
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_ID AS JOB_DATA_ID,
".$DBConn->GetPrefix()."JOB_DATA.ACCESS_LEVEL_ID AS JOB_DATA_ACCESS,
".$DBConn->GetPrefix()."JOB_DATA.AVAILABLE_ID AS JOB_DATA_AVAIL,
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_Title AS JOB_DATA_TITLE,
".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_Date AS JOB_DATA_DATE,
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_ID AS JOB_INC_ID,
".$DBConn->GetPrefix()."JOB_INCOME.ACCESS_LEVEL_ID AS JOB_INC_ACCESS,
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_Price AS JOB_INC_PRICE,
".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_PIA AS JOB_INC_PIA,
".$DBConn->GetPrefix()."JOB_INCOME.AVAILABLE_ID AS JOB_INC_AVAIL,
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$DBConn->GetPrefix()."JOB_OUTCOME.ACCESS_LEVEL_ID AS JOB_OUT_ACCESS,
".$DBConn->GetPrefix()."JOB_OUTCOME.AVAILABLE_ID AS JOB_OUT_AVAIL,
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_Expenses AS JOB_OUT_EXP,
".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_Damage AS JOB_OUT_DAM,
".$DBConn->GetPrefix()."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS,
".$DBConn->GetPrefix()."COMPANY.AVAILABLE_ID AS COMP_AVAIL,
".$DBConn->GetPrefix()."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS,
".$DBConn->GetPrefix()."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE
FROM
".$DBConn->GetPrefix()."JOB,
".$DBConn->GetPrefix()."JOB_DATA,
".$DBConn->GetPrefix()."JOB_OUTCOME,
".$DBConn->GetPrefix()."JOB_INCOME,
".$DBConn->GetPrefix()."COMPANY,
".$DBConn->GetPrefix()."COMPANY_DATA
WHERE
(".$DBConn->GetPrefix()."COMPANY.COMPANY_DATA_ID = ".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_ID
AND ".$DBConn->GetPrefix()."JOB_OUTCOME.JOB_OUTCOME_ID = ".$DBConn->GetPrefix()."JOB.JOB_OUTCOME_ID
AND ".$DBConn->GetPrefix()."JOB_INCOME.JOB_INCOME_ID = ".$DBConn->GetPrefix()."JOB.JOB_INCOME_ID
AND ".$DBConn->GetPrefix()."JOB_DATA.JOB_DATA_ID = ".$DBConn->GetPrefix()."JOB.JOB_DATA_ID
AND ".$DBConn->GetPrefix()."JOB.COMPANY_ID = ".$DBConn->GetPrefix()."COMPANY.COMPANY_ID);";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_JOB_GENERAL");
else
	printf("<br>ERROR 18 " . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW CUSTOMER TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_CUSTOMER AS
SELECT
".$DBConn->GetPrefix()."CUSTOMER.CUSTOMER_ID AS CUST_ID,
".$DBConn->GetPrefix()."CUSTOMER.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$DBConn->GetPrefix()."CUSTOMER.ACCESS_LEVEL_ID AS CUST_ACCESS,
".$DBConn->GetPrefix()."CUSTOMER.AVAILABLE_ID AS CUST_AVAIL
FROM
".$DBConn->GetPrefix()."CUSTOMER;";

if($DBConn->ExecQuery($DBQuery));

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_CUSTOMER");
else
	printf("<br>ERROR 19 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_CUSTOMER_DATA AS
SELECT
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Name AS CUST_DATA_NAME,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Surname AS CUST_DATA_SURNAME,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_PN AS CUST_DATA_PN,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_SN AS CUST_DATA_SN,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Email AS CUST_DATA_EMAIL,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_ADDR AS CUST_DATA_ADDR,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Note AS CUST_DATA_NOTE,
".$DBConn->GetPrefix()."CUSTOMER_DATA.ACCESS_LEVEL_ID AS CUST_DATA_ACCESS,
".$DBConn->GetPrefix()."CUSTOMER_DATA.AVAILABLE_ID AS CUST_DATA_AVAIL
FROM
".$DBConn->GetPrefix()."CUSTOMER_DATA;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_CUSTOMER_DATA");
else
	printf("<br>ERROR 20" . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_CUSTOMER_GENERAL AS
SELECT
".$DBConn->GetPrefix()."CUSTOMER.CUSTOMER_ID AS CUST_ID,
".$DBConn->GetPrefix()."CUSTOMER.AVAILABLE_ID AS CUST_AVAIL,
".$DBConn->GetPrefix()."CUSTOMER.ACCESS_LEVEL_ID AS CUST_ACCESS,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$DBConn->GetPrefix()."CUSTOMER_DATA.AVAILABLE_ID AS CUST_DATA_AVAIL,
".$DBConn->GetPrefix()."CUSTOMER_DATA.ACCESS_LEVEL_ID AS CUST_DATA_ACCESS,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Name AS CUST_DATA_NAME,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Surname AS CUST_DATA_SURNAME,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Email AS CUST_DATA_EMAIL,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_PN AS CUST_DATA_PN,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_SN AS CUST_DATA_SN,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Addr AS CUST_DATA_ADDR,
".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_Note AS CUST_DATA_NOTE
FROM
".$DBConn->GetPrefix()."CUSTOMER,
".$DBConn->GetPrefix()."CUSTOMER_DATA
WHERE
(".$DBConn->GetPrefix()."CUSTOMER.CUSTOMER_DATA_ID = ".$DBConn->GetPrefix()."CUSTOMER_DATA.CUSTOMER_DATA_ID);";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_CUSTOMER_GENERAL");
else
	printf("<br>ERROR 21" . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW SHAREHOLDER TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_SHAREHOLDER AS
SELECT
".$DBConn->GetPrefix()."SHAREHOLDER.SHAREHOLDER_ID AS SHARE_ID,
".$DBConn->GetPrefix()."SHAREHOLDER.EMPLOYEE_ID AS EMP_ID,
".$DBConn->GetPrefix()."SHAREHOLDER.ACCESS_LEVEL_ID AS SHARE_ACCESS,
".$DBConn->GetPrefix()."SHAREHOLDER.AVAILABLE_ID AS SHARE_AVAIL
FROM
".$DBConn->GetPrefix()."SHAREHOLDER;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_SHAREHOLDER");
else
	printf("<br>ERROR 22 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_SHAREHOLDER_GENERAL AS
SELECT
".$DBConn->GetPrefix()."SHAREHOLDER.SHAREHOLDER_ID AS SHARE_ID,
".$DBConn->GetPrefix()."SHAREHOLDER.EMPLOYEE_ID AS EMP_ID,
".$DBConn->GetPrefix()."SHAREHOLDER.ACCESS_LEVEL_ID AS SHARE_ACCESS,
".$DBConn->GetPrefix()."SHAREHOLDER.AVAILABLE_ID AS SHARE_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.ACCESS_LEVEL_ID AS EMP_DATA_ACCESS,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Salary AS EMP_DATA_SALARY,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_BDay AS EMP_DATA_BDAY,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME,
".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_Title AS EMP_POS_TITLE
FROM
".$DBConn->GetPrefix()."SHAREHOLDER,
".$DBConn->GetPrefix()."EMPLOYEE,
".$DBConn->GetPrefix()."EMPLOYEE_POSITION,
".$DBConn->GetPrefix()."EMPLOYEE_DATA
WHERE
(".$DBConn->GetPrefix()."SHAREHOLDER.EMPLOYEE_ID = ".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_ID
AND ".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_DATA_ID = ".$DBConn->GetPrefix()."EMPLOYEE_DATA.EMPLOYEE_DATA_ID
AND ".$DBConn->GetPrefix()."EMPLOYEE.EMPLOYEE_POSITION_ID = ".$DBConn->GetPrefix()."EMPLOYEE_POSITION.EMPLOYEE_POSITION_ID);";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_SHAREHOLDER_GENERAL");
else
	printf("<br>ERROR 23 " . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW COMPANY TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COMPANY AS
SELECT
".$DBConn->GetPrefix()."COMPANY.COMPANY_ID AS COMP_ID,
".$DBConn->GetPrefix()."COMPANY.COMPANY_DATA_ID AS COMP_DATA_ID,
".$DBConn->GetPrefix()."COMPANY.COUNTY_ID AS COU_ID,
".$DBConn->GetPrefix()."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS,
".$DBConn->GetPrefix()."COMPANY.AVAILABLE_ID AS COMP_AVAIL
FROM
".$DBConn->GetPrefix()."COMPANY;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COMPANY");
else
	printf("<br>ERROR 24 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COMPANY_DATA AS
SELECT
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_ID AS COMP_DATA_ID,
".$DBConn->GetPrefix()."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS,
".$DBConn->GetPrefix()."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE
FROM
".$DBConn->GetPrefix()."COMPANY_DATA;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COMPANY_DATA");
else
	printf("<br>ERROR 25 " . $DBViewErrorMsg . $DBConn->GetError());

$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_COMPANY_GENERAL AS
SELECT
".$DBConn->GetPrefix()."COMPANY.COMPANY_ID AS COMP_ID,
".$DBConn->GetPrefix()."COMPANY.COUNTY_ID AS COU_ID,
".$DBConn->GetPrefix()."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS,
".$DBConn->GetPrefix()."COMPANY.AVAILABLE_ID AS COMP_AVAIL,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_ID AS COMP_DATA_ID,
".$DBConn->GetPrefix()."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS,
".$DBConn->GetPrefix()."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE,
".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_Title AS COUN_DATA_TITLE,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_Date AS COU_DATA_DATE
FROM
".$DBConn->GetPrefix()."COMPANY,
".$DBConn->GetPrefix()."COMPANY_DATA,
".$DBConn->GetPrefix()."COUNTRY,
".$DBConn->GetPrefix()."COUNTRY_DATA,
".$DBConn->GetPrefix()."COUNTY,
".$DBConn->GetPrefix()."COUNTY_DATA
WHERE
".$DBConn->GetPrefix()."COMPANY.COMPANY_DATA_ID = ".$DBConn->GetPrefix()."COMPANY_DATA.COMPANY_DATA_ID
AND ".$DBConn->GetPrefix()."COMPANY.COUNTY_ID = ".$DBConn->GetPrefix()."COUNTY.COUNTY_ID
AND ".$DBConn->GetPrefix()."COUNTY_DATA.COUNTY_DATA_ID = ".$DBConn->GetPrefix()."COUNTY.COUNTY_DATA_ID
AND ".$DBConn->GetPrefix()."COUNTRY.COUNTRY_ID = ".$DBConn->GetPrefix()."COUNTY.COUNTRY_ID
AND ".$DBConn->GetPrefix()."COUNTRY_DATA.COUNTRY_DATA_ID = ".$DBConn->GetPrefix()."COUNTRY.COUNTRY_DATA_ID;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_COMPANY_GENERAL");
else
	printf("<br>ERROR 26 " . $DBViewErrorMsg . $DBConn->GetError());

/*--------<VIEW ACCESS TABLES>--------*/
$DBQuery="CREATE ALGORITHM = MERGE VIEW ".$DBConn->GetPrefix()."VIEW_ACCESS AS
SELECT
".$DBConn->GetPrefix()."ACCESS_LEVEL.ACCESS_LEVEL_ID AS ACCESS_ID,
".$DBConn->GetPrefix()."ACCESS_LEVEL.ACCESS_LEVEL_Title AS ACCESS_TITLE,
".$DBConn->GetPrefix()."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS ACCESS_LEVEL,
".$DBConn->GetPrefix()."ACCESS_LEVEL.AVAILABLE_ID AS ACCESS_AVAIL
FROM
".$DBConn->GetPrefix()."ACCESS_LEVEL;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>" . $DBViewSuccMsg . " -> VIEW_ACCESS");
else
	printf("<br>ERROR 27 " . $DBViewErrorMsg . $DBConn->GetError());
?>
