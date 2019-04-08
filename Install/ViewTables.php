<?php
/*----Create view tables*/

printf("<br><h1>VIEW TABLE</h1><br>");

/*--------<VIEW ACCESS TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_ACCESS AS
SELECT
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID AS ACCESS_ID,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Title AS ACCESS_TITLE,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS ACCESS_LEVEL,
".$sPrefix."ACCESS_LEVEL.AVAILABLE_ID AS ACCESS_AVAIL
FROM
".$sPrefix."ACCESS_LEVEL;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_ACCESS", $DBViewSuccMsg);
else
	printf("<br>ERROR 27 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW EMPLOYEE TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE AS
SELECT
".$sPrefix."EMPLOYEE.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."EMPLOYEE.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$sPrefix."EMPLOYEE.COMPANY_ID AS COMP_ID,
".$sPrefix."EMPLOYEE.EMPLOYEE_DATA_ID AS EMP_DATA_ID,
".$sPrefix."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS EMP_ACCESS
FROM
".$sPrefix."EMPLOYEE,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."EMPLOYEE.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE", $DBViewSuccMsg);
else
	printf("<br>ERROR 1 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_POSITION AS
SELECT
".$sPrefix."EMPLOYEE_POSITION.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$sPrefix."EMPLOYEE_POSITION.EMPLOYEE_POSITION_Title AS EMP_POS_TITLE,
".$sPrefix."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS EMP_POS_ACCESS
FROM
".$sPrefix."EMPLOYEE_POSITION,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."EMPLOYEE_POSITION.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_POSITION", $DBViewSuccMsg);
else
	printf("<br>ERROR 2 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_DATA AS
SELECT
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_ID AS EMP_DATA_ID,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Salary AS EMP_DATA_SALARY,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_PassWord AS EMP_DATA_PASS,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_BDay AS EMP_DATA_BDAY,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_PN AS EMP_DATA_PN,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_SN AS EMP_DATA_SN,
".$sPrefix."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS EMP_DATA_ACCESS
FROM
".$sPrefix."EMPLOYEE_DATA,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."EMPLOYEE_DATA.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_DATA", $DBViewSuccMsg);
else
	printf("<br>ERROR 3 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW COUNTRY TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY AS
SELECT
".$sPrefix."COUNTRY.COUNTRY_ID AS COUN_ID,
".$sPrefix."COUNTRY.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$sPrefix."COUNTRY.AVAILABLE_ID AS COUN_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS COUN_ACCESS
FROM
".$sPrefix."COUNTRY,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."COUNTRY.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY", $DBViewSuccMsg);
else
	printf("<br>ERROR 6 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_DATA AS
SELECT
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_Title AS COUN_DATA_TITLE,
".$sPrefix."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS COUN_DATA_ACCESS
FROM
".$sPrefix."COUNTRY_DATA,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."COUNTRY_DATA.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_DATA", $DBViewSuccMsg);
else
	printf("<br>ERROR 7 %s %s", $DBViewErrorMsg , $DBConn->GetError());

/*--------<VIEW COUNTY TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY AS
SELECT
".$sPrefix."COUNTY.COUNTY_ID AS COU_ID,
".$sPrefix."COUNTY.COUNTY_DATA_ID AS COU_DATA_ID,
".$sPrefix."COUNTY.COUNTRY_ID AS COUN_ID,
".$sPrefix."COUNTY.AVAILABLE_ID AS COU_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS COU_ACCESS
FROM
".$sPrefix."COUNTY,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."COUNTY.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY", $DBViewSuccMsg);
else
	printf("<br>ERROR 9 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_DATA AS
SELECT
".$sPrefix."COUNTY_DATA.COUNTY_DATA_ID AS COU_DATA_ID,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$sPrefix."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS COU_DATA_ACCESS
FROM
".$sPrefix."COUNTY_DATA,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."COUNTY_DATA.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_DATA", $DBViewSuccMsg);
else
	printf("<br>ERROR 10 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW JOB TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_ASSIGMENT AS
SELECT
".$sPrefix."JOB_ASSIGMENT.JOB_ASSIGMENT_ID AS JOB_ASS_ID,
".$sPrefix."JOB_ASSIGMENT.ACCESS_LEVEL_ID AS JOB_ASS_ACCESS,
".$sPrefix."JOB_ASSIGMENT.CUSTOMER_ID AS CUST_ID,
".$sPrefix."JOB_ASSIGMENT.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."JOB_ASSIGMENT.JOB_ID AS JOB_ID,
".$sPrefix."JOB_ASSIGMENT.AVAILABLE_ID AS JOB_ASS_AVAIL,
".$sPrefix."JOB_ASSIGMENT.JOB_ASSIGMENT_CDate AS JOB_ASS_CDATE
FROM
".$sPrefix."JOB_ASSIGMENT;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_ASSIGMENT", $DBViewSuccMsg);
else
	printf("<br>ERROR 12 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB AS
SELECT
".$sPrefix."JOB.JOB_ID AS JOB_ID,
".$sPrefix."JOB.JOB_DATA_ID AS JOB_DATA_ID,
".$sPrefix."JOB.JOB_INCOME_ID AS JOB_INC_ID,
".$sPrefix."JOB.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$sPrefix."JOB.COMPANY_ID AS COMP_ID,
".$sPrefix."JOB.AVAILABLE_ID AS JOB_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS JOB_ACCESS
FROM
".$sPrefix."JOB,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."JOB.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB", $DBViewSuccMsg);
else
	printf("<br>ERROR 13 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_DATA AS
SELECT
".$sPrefix."JOB_DATA.JOB_DATA_ID AS JOB_DATA_ID,
".$sPrefix."JOB_DATA.JOB_DATA_Title AS JOB_DATA_TITLE,
".$sPrefix."JOB_DATA.JOB_DATA_Date AS JOB_DATA_DATE,
".$sPrefix."JOB_DATA.AVAILABLE_ID AS JOB_DATA_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS JOB_DATA_ACCESS
FROM
".$sPrefix."JOB_DATA,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."JOB_DATA.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_DATA", $DBViewSuccMsg);
else
	printf("<br>ERROR 14 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME AS
SELECT
".$sPrefix."JOB_INCOME.JOB_INCOME_ID AS JOB_INC_ID,
".$sPrefix."JOB_INCOME.JOB_INCOME_Price AS JOB_INC_PRICE,
".$sPrefix."JOB_INCOME.JOB_INCOME_PIA AS JOB_INC_PIA,
".$sPrefix."JOB_INCOME.AVAILABLE_ID AS JOB_INC_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS JOB_INC_ACCESS
FROM
".$sPrefix."JOB_INCOME,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."JOB_INCOME.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME", $DBViewSuccMsg);
else
	printf("<br>ERROR 15 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_OUTCOME AS
SELECT
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_Expenses AS JOB_OUT_EXPENSES,
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_Damage AS JOB_OUT_DAMAGE,
".$sPrefix."JOB_OUTCOME.AVAILABLE_ID AS JOB_OUT_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS JOB_OUT_ACCESS
FROM
".$sPrefix."JOB_OUTCOME,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."JOB_OUTCOME.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_OUTCOME", $DBViewSuccMsg);
else
	printf("<br>ERROR 16 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_TIME AS
SELECT
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_ID AS JOB_PIT_ID,
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_PIT AS JOB_PIT_PAYMENT,
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_Date AS JOB_PIT_DATE,
".$sPrefix."JOB_INCOME_TIME.JOB_ID AS JOB_ID,
".$sPrefix."JOB_INCOME_TIME.AVAILABLE_ID AS JOB_PIT_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS JOB_PIT_ACCESS
FROM
".$sPrefix."JOB_INCOME_TIME,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."JOB_INCOME_TIME.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_TIME", $DBViewSuccMsg);
else
	printf("<br>ERROR 17 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW CUSTOMER TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER AS
SELECT
".$sPrefix."CUSTOMER.CUSTOMER_ID AS CUST_ID,
".$sPrefix."CUSTOMER.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$sPrefix."CUSTOMER.AVAILABLE_ID AS CUST_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS CUST_ACCESS
FROM
".$sPrefix."CUSTOMER,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."CUSTOMER.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

if($DBConn->ExecQuery($sDBQuery));

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER", $DBViewSuccMsg);
else
	printf("<br>ERROR 19 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_DATA AS
SELECT
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Name AS CUST_DATA_NAME,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Surname AS CUST_DATA_SURNAME,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_PN AS CUST_DATA_PN,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_SN AS CUST_DATA_SN,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Email AS CUST_DATA_EMAIL,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Addr AS CUST_DATA_ADDR,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Note AS CUST_DATA_NOTE,
".$sPrefix."CUSTOMER_DATA.AVAILABLE_ID AS CUST_DATA_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS CUST_DATA_ACCESS
FROM
".$sPrefix."CUSTOMER_DATA,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."CUSTOMER_DATA.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_DATA", $DBViewSuccMsg);
else
	printf("<br>ERROR 20 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW SHAREHOLDER TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_SHAREHOLDER AS
SELECT
".$sPrefix."SHAREHOLDER.SHAREHOLDER_ID AS SHARE_ID,
".$sPrefix."SHAREHOLDER.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."SHAREHOLDER.AVAILABLE_ID AS SHARE_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS SHARE_ACCESS
FROM
".$sPrefix."SHAREHOLDER,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."SHAREHOLDER.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_SHAREHOLDER", $DBViewSuccMsg);
else
	printf("<br>ERROR 22 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW COMPANY TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY AS
SELECT
".$sPrefix."COMPANY.COMPANY_ID AS COMP_ID,
".$sPrefix."COMPANY.COMPANY_DATA_ID AS COMP_DATA_ID,
".$sPrefix."COMPANY.COUNTY_ID AS COU_ID,
".$sPrefix."COMPANY.AVAILABLE_ID AS COMP_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS COMP_ACCESS
FROM
".$sPrefix."COMPANY,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."COMPANY.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY", $DBViewSuccMsg);
else
	printf("<br>ERROR 24 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_DATA AS
SELECT
".$sPrefix."COMPANY_DATA.COMPANY_DATA_ID AS COMP_DATA_ID,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE,
".$sPrefix."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL,
".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_Clearance AS COMP_DATA_ACCESS
FROM
".$sPrefix."COMPANY_DATA,
".$sPrefix."ACCESS_LEVEL
WHERE
(".$sPrefix."COMPANY_DATA.ACCESS_LEVEL_ID = ".$sPrefix."ACCESS_LEVEL.ACCESS_LEVEL_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_DATA", $DBViewSuccMsg);
else
	printf("<br>ERROR 25 %s %s", $DBViewErrorMsg, $DBConn->GetError());

/*--------<VIEW SPECIFIC TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_VISIBILITY AS
SELECT
".$sPrefix."COMPANY.COMPANY_ID AS COMP_ID,
".$sPrefix."COMPANY.AVAILABLE_ID AS COMP_AVAIL_ID
FROM
".$sPrefix."COMPANY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_DATA_VISIBILITY AS
SELECT
".$sPrefix."COMPANY_DATA.COMPANY_DATA_ID AS COMP_DATA_ID,
".$sPrefix."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL_ID
FROM
".$sPrefix."COMPANY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_DATA_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_VISIBILITY AS
SELECT
".$sPrefix."COUNTRY.COUNTRY_ID AS COUN_ID,
".$sPrefix."COUNTRY.AVAILABLE_ID AS COUN_AVAIL_ID
FROM
".$sPrefix."COUNTRY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_DATA_VISIBILITY AS
SELECT
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$sPrefix."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL_ID
FROM
".$sPrefix."COUNTRY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_DATA_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_VISIBILITY AS
SELECT
".$sPrefix."COUNTY.COUNTY_ID AS COU_ID,
".$sPrefix."COUNTY.AVAILABLE_ID AS COU_AVAIL_ID
FROM
".$sPrefix."COUNTY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_DATA_VISIBILITY AS
SELECT
".$sPrefix."COUNTY_DATA.COUNTY_DATA_ID AS COU_DATA_ID,
".$sPrefix."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL_ID
FROM
".$sPrefix."COUNTY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_DATA_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_VISIBILITY AS
SELECT
".$sPrefix."CUSTOMER.CUSTOMER_ID AS CUST_ID,
".$sPrefix."CUSTOMER.AVAILABLE_ID AS CUST_AVAIL_ID
FROM
".$sPrefix."CUSTOMER;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_DATA_VISIBILITY AS
SELECT
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$sPrefix."CUSTOMER_DATA.AVAILABLE_ID AS CUST_DATA_AVAIL_ID
FROM
".$sPrefix."CUSTOMER_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_DATA_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_VISIBILITY AS
SELECT
".$sPrefix."EMPLOYEE.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_DATA_VISIBILITY AS
SELECT
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_ID AS EMP_DATA_ID,
".$sPrefix."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_DATA_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_POSITION_VISIBILITY AS
SELECT
".$sPrefix."EMPLOYEE_POSITION.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$sPrefix."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE_POSITION;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_POSITION_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_VISIBILITY AS
SELECT
".$sPrefix."JOB.JOB_ID AS JOB_ID,
".$sPrefix."JOB.AVAILABLE_ID AS JOB_AVAIL_ID
FROM
".$sPrefix."JOB;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_DATA_VISIBILITY AS
SELECT
".$sPrefix."JOB_DATA.JOB_DATA_ID AS JOB_DATA_ID,
".$sPrefix."JOB_DATA.AVAILABLE_ID AS JOB_DATA_AVAIL_ID
FROM
".$sPrefix."JOB_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_DATA_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_VISIBILITY AS
SELECT
".$sPrefix."JOB_INCOME.JOB_INCOME_ID AS JOB_INC_ID,
".$sPrefix."JOB_INCOME.AVAILABLE_ID AS JOB_INC_AVAIL_ID
FROM
".$sPrefix."JOB_INCOME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_OUTCOME_VISIBILITY AS
SELECT
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$sPrefix."JOB_OUTCOME.AVAILABLE_ID AS JOB_OUT_AVAIL_ID
FROM
".$sPrefix."JOB_OUTCOME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_OUTCOME_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY AS
SELECT
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_ID AS JOB_PIT_ID,
".$sPrefix."JOB_INCOME_TIME.AVAILABLE_ID AS JOB_PIT_AVAIL_ID
FROM
".$sPrefix."JOB_INCOME_TIME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_TIME_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_SHAREHOLDER_VISIBILITY AS
SELECT
".$sPrefix."SHAREHOLDER.SHAREHOLDER_ID AS SHARE_ID,
".$sPrefix."SHAREHOLDER.AVAILABLE_ID AS SHARE_AVAIL_ID
FROM
".$sPrefix."SHAREHOLDER;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_SHAREHOLDER_VISIBILITY", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_ADD AS
SELECT
".$sPrefix."COMPANY.COMPANY_DATA_ID AS COMP_DATA_ID,
".$sPrefix."COMPANY.COUNTY_ID AS COU_ID,
".$sPrefix."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS_ID,
".$sPrefix."COMPANY.AVAILABLE_ID AS COMP_AVAIL_ID
FROM
".$sPrefix."COMPANY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_DATA_ADD AS
SELECT
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE,
".$sPrefix."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS_ID,
".$sPrefix."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL_ID
FROM
".$sPrefix."COMPANY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_DATA_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_ADD AS
SELECT
".$sPrefix."COUNTRY.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$sPrefix."COUNTRY.ACCESS_LEVEL_ID AS COUN_ACCESS_ID,
".$sPrefix."COUNTRY.AVAILABLE_ID AS COUN_AVAIL_ID
FROM
".$sPrefix."COUNTRY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_DATA_ADD AS
SELECT
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_Title AS COUN_DATA_TITLE,
".$sPrefix."COUNTRY_DATA.ACCESS_LEVEL_ID AS COUN_DATA_ACCESS_ID,
".$sPrefix."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL_ID
FROM
".$sPrefix."COUNTRY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_DATA_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_ADD AS
SELECT
".$sPrefix."COUNTY.COUNTY_DATA_ID AS COU_DATA_ID,
".$sPrefix."COUNTY.COUNTRY_ID AS COUN_ID,
".$sPrefix."COUNTY.ACCESS_LEVEL_ID AS COU_ACCESS_ID,
".$sPrefix."COUNTY.AVAILABLE_ID AS COU_AVAIL_ID
FROM
".$sPrefix."COUNTY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_DATA_ADD AS
SELECT
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$sPrefix."COUNTY_DATA.ACCESS_LEVEL_ID AS COU_DATA_ACCESS_ID,
".$sPrefix."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL_ID
FROM
".$sPrefix."COUNTY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_DATA_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_ADD AS
SELECT
".$sPrefix."CUSTOMER.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$sPrefix."CUSTOMER.ACCESS_LEVEL_ID AS CUST_ACCESS_ID,
".$sPrefix."CUSTOMER.AVAILABLE_ID AS CUST_AVAIL_ID
FROM
".$sPrefix."CUSTOMER;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_DATA_ADD AS
SELECT
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Name AS CUST_DATA_NAME,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Surname AS CUST_DATA_SURNAME,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_PN AS CUST_DATA_PN,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_SN AS CUST_DATA_SN,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Email AS CUST_DATA_EMAIL,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Addr AS CUST_DATA_ADDR,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Note AS CUST_DATA_NOTE,
".$sPrefix."CUSTOMER_DATA.ACCESS_LEVEL_ID AS CUST_DATA_ACCESS_ID,
".$sPrefix."CUSTOMER_DATA.AVAILABLE_ID AS CUST_DATA_AVAIL_ID
FROM
".$sPrefix."CUSTOMER_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_DATA_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_ADD AS
SELECT
".$sPrefix."EMPLOYEE.EMPLOYEE_DATA_ID AS EMP_DATA_ID,
".$sPrefix."EMPLOYEE.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$sPrefix."EMPLOYEE.COMPANY_ID AS COMP_ID,
".$sPrefix."EMPLOYEE.ACCESS_LEVEL_ID AS EMP_ACCESS_ID,
".$sPrefix."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_DATA_ADD AS
SELECT
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Salary AS EMP_DATA_SALARY,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_BDay AS EMP_DATA_BDAY,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_PassWord AS EMP_DATA_PASS,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_PN AS EMP_DATA_PN,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_SN AS EMP_DATA_SN,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME,
".$sPrefix."EMPLOYEE_DATA.ACCESS_LEVEL_ID AS EMP_DATA_ACCESS_ID,
".$sPrefix."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_DATA_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_POSITION_ADD AS
SELECT
".$sPrefix."EMPLOYEE_POSITION.EMPLOYEE_POSITION_Title AS EMP_POS_TITLE,
".$sPrefix."EMPLOYEE_POSITION.ACCESS_LEVEL_ID AS EMP_POS_ACCESS_ID,
".$sPrefix."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE_POSITION;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_POSITION_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_ADD AS
SELECT
".$sPrefix."JOB.JOB_DATA_ID AS JOB_DATA_ID,
".$sPrefix."JOB.JOB_INCOME_ID AS JOB_INC_ID,
".$sPrefix."JOB.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$sPrefix."JOB.COMPANY_ID AS COMP_ID,
".$sPrefix."JOB.ACCESS_LEVEL_ID AS JOB_ACCESS_ID,
".$sPrefix."JOB.AVAILABLE_ID AS JOB_AVAIL_ID
FROM
".$sPrefix."JOB;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_DATA_ADD AS
SELECT
".$sPrefix."JOB_DATA.JOB_DATA_Title AS JOB_DATA_TITLE,
".$sPrefix."JOB_DATA.JOB_DATA_Date AS JOB_DATA_DATE,
".$sPrefix."JOB_DATA.ACCESS_LEVEL_ID AS JOB_DATA_ACCESS_ID,
".$sPrefix."JOB_DATA.AVAILABLE_ID AS JOB_DATA_AVAIL_ID
FROM
".$sPrefix."JOB_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_DATA_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_ADD AS
SELECT
".$sPrefix."JOB_INCOME.JOB_INCOME_Price AS JOB_INC_PRICE,
".$sPrefix."JOB_INCOME.JOB_INCOME_PIA AS JOB_INC_PIA,
".$sPrefix."JOB_INCOME.ACCESS_LEVEL_ID AS JOB_INC_ACCESS_ID,
".$sPrefix."JOB_INCOME.AVAILABLE_ID AS JOB_INC_AVAIL_ID
FROM
".$sPrefix."JOB_INCOME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_OUTCOME_ADD AS
SELECT
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_Expenses AS JOB_OUT_EXPENSES,
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_Damage AS JOB_OUT_DAMAGE,
".$sPrefix."JOB_OUTCOME.ACCESS_LEVEL_ID AS JOB_OUT_ACCESS_ID,
".$sPrefix."JOB_OUTCOME.AVAILABLE_ID AS JOB_OUT_AVAIL_ID
FROM
".$sPrefix."JOB_OUTCOME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_OUTCOME_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_TIME_ADD AS
SELECT
".$sPrefix."JOB_INCOME_TIME.JOB_ID AS JOB_ID,
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_PIT AS JOB_PIT_PAYMENT,
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_Date AS JOB_PIT_DATE,
".$sPrefix."JOB_INCOME_TIME.ACCESS_LEVEL_ID AS JOB_PIT_ACCESS_ID,
".$sPrefix."JOB_INCOME_TIME.AVAILABLE_ID AS JOB_PIT_AVAIL_ID
FROM
".$sPrefix."JOB_INCOME_TIME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_TIME_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_SHAREHOLDER_ADD AS
SELECT
".$sPrefix."SHAREHOLDER.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."SHAREHOLDER.ACCESS_LEVEL_ID AS SHARE_ACCESS_ID,
".$sPrefix."SHAREHOLDER.AVAILABLE_ID AS SHARE_AVAIL_ID
FROM
".$sPrefix."SHAREHOLDER;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_SHAREHOLDER_ADD", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_EDIT AS
SELECT
".$sPrefix."COMPANY.COMPANY_ID AS COMP_ID,
".$sPrefix."COMPANY.COUNTY_ID AS COU_ID,
".$sPrefix."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS_ID,
".$sPrefix."COMPANY.AVAILABLE_ID AS COMP_AVAIL_ID
FROM
".$sPrefix."COMPANY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_DATA_EDIT AS
SELECT
".$sPrefix."COMPANY_DATA.COMPANY_DATA_ID AS COMP_DATA_ID,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE,
".$sPrefix."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS_ID,
".$sPrefix."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL_ID
FROM
".$sPrefix."COMPANY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_DATA_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_EDIT AS
SELECT
".$sPrefix."COUNTRY.COUNTRY_ID AS COUN_ID,
".$sPrefix."COUNTRY.ACCESS_LEVEL_ID AS COUN_ACCESS_ID,
".$sPrefix."COUNTRY.AVAILABLE_ID AS COUN_AVAIL_ID
FROM
".$sPrefix."COUNTRY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_DATA_EDIT AS
SELECT
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_ID AS COUN_DATA_ID,
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_Title AS COUN_DATA_TITLE,
".$sPrefix."COUNTRY_DATA.ACCESS_LEVEL_ID AS COUN_DATA_ACCESS_ID,
".$sPrefix."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL_ID
FROM
".$sPrefix."COUNTRY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_DATA_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_EDIT AS
SELECT
".$sPrefix."COUNTY.COUNTY_ID AS COU_ID,
".$sPrefix."COUNTY.COUNTRY_ID AS COUN_ID,
".$sPrefix."COUNTY.ACCESS_LEVEL_ID AS COU_ACCESS_ID,
".$sPrefix."COUNTY.AVAILABLE_ID AS COU_AVAIL_ID
FROM
".$sPrefix."COUNTY;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_DATA_EDIT AS
SELECT
".$sPrefix."COUNTY_DATA.COUNTY_DATA_ID AS COU_DATA_ID,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$sPrefix."COUNTY_DATA.ACCESS_LEVEL_ID AS COU_DATA_ACCESS_ID,
".$sPrefix."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL_ID
FROM
".$sPrefix."COUNTY_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_DATA_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_EDIT AS
SELECT
".$sPrefix."CUSTOMER.CUSTOMER_ID AS CUST_ID,
".$sPrefix."CUSTOMER.ACCESS_LEVEL_ID AS CUST_ACCESS_ID,
".$sPrefix."CUSTOMER.AVAILABLE_ID AS CUST_AVAIL_ID
FROM
".$sPrefix."CUSTOMER;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_DATA_EDIT AS
SELECT
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_ID AS CUST_DATA_ID,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Name AS CUST_DATA_NAME,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Surname AS CUST_DATA_SURNAME,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_PN AS CUST_DATA_PN,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_SN AS CUST_DATA_SN,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Email AS CUST_DATA_EMAIL,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Addr AS CUST_DATA_ADDR,
".$sPrefix."CUSTOMER_DATA.CUSTOMER_DATA_Note AS CUST_DATA_NOTE,
".$sPrefix."CUSTOMER_DATA.ACCESS_LEVEL_ID AS CUST_DATA_ACCESS_ID,
".$sPrefix."CUSTOMER_DATA.AVAILABLE_ID AS CUST_DATA_AVAIL_ID
FROM
".$sPrefix."CUSTOMER_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_DATA_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_EDIT AS
SELECT
".$sPrefix."EMPLOYEE.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."EMPLOYEE.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$sPrefix."EMPLOYEE.COMPANY_ID AS COMP_ID,
".$sPrefix."EMPLOYEE.ACCESS_LEVEL_ID AS EMP_ACCESS_ID,
".$sPrefix."EMPLOYEE.AVAILABLE_ID AS EMP_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_DATA_EDIT AS
SELECT
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_ID AS EMP_DATA_ID,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Salary AS EMP_DATA_SALARY,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_BDay AS EMP_DATA_BDAY,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_PN AS EMP_DATA_PN,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_SN AS EMP_DATA_SN,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Email AS EMP_DATA_EMAIL,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Name AS EMP_DATA_NAME,
".$sPrefix."EMPLOYEE_DATA.EMPLOYEE_DATA_Surname AS EMP_DATA_SURNAME,
".$sPrefix."EMPLOYEE_DATA.ACCESS_LEVEL_ID AS EMP_DATA_ACCESS_ID,
".$sPrefix."EMPLOYEE_DATA.AVAILABLE_ID AS EMP_DATA_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_DATA_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_POSITION_EDIT AS
SELECT
".$sPrefix."EMPLOYEE_POSITION.EMPLOYEE_POSITION_ID AS EMP_POS_ID,
".$sPrefix."EMPLOYEE_POSITION.EMPLOYEE_POSITION_Title AS EMP_POS_TITLE,
".$sPrefix."EMPLOYEE_POSITION.ACCESS_LEVEL_ID AS EMP_POS_ACCESS_ID,
".$sPrefix."EMPLOYEE_POSITION.AVAILABLE_ID AS EMP_POS_AVAIL_ID
FROM
".$sPrefix."EMPLOYEE_POSITION;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_POSITION_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_EDIT AS
SELECT
".$sPrefix."JOB.JOB_ID AS JOB_ID,
".$sPrefix."JOB.COMPANY_ID AS COMP_ID,
".$sPrefix."JOB.ACCESS_LEVEL_ID AS JOB_ACCESS_ID,
".$sPrefix."JOB.AVAILABLE_ID AS JOB_AVAIL_ID
FROM
".$sPrefix."JOB;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_DATA_EDIT AS
SELECT
".$sPrefix."JOB_DATA.JOB_DATA_ID AS JOB_DATA_ID,
".$sPrefix."JOB_DATA.JOB_DATA_Title AS JOB_DATA_TITLE,
".$sPrefix."JOB_DATA.ACCESS_LEVEL_ID AS JOB_DATA_ACCESS_ID,
".$sPrefix."JOB_DATA.AVAILABLE_ID AS JOB_DATA_AVAIL_ID
FROM
".$sPrefix."JOB_DATA;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_DATA_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_EDIT AS
SELECT
".$sPrefix."JOB_INCOME.JOB_INCOME_ID AS JOB_INC_ID,
".$sPrefix."JOB_INCOME.JOB_INCOME_Price AS JOB_INC_PRICE,
".$sPrefix."JOB_INCOME.JOB_INCOME_PIA AS JOB_INC_PIA,
".$sPrefix."JOB_INCOME.ACCESS_LEVEL_ID AS JOB_INC_ACCESS_ID,
".$sPrefix."JOB_INCOME.AVAILABLE_ID AS JOB_INC_AVAIL_ID
FROM
".$sPrefix."JOB_INCOME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_OUTCOME_EDIT AS
SELECT
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_ID AS JOB_OUT_ID,
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_Expenses AS JOB_OUT_EXPENSES,
".$sPrefix."JOB_OUTCOME.JOB_OUTCOME_Damage AS JOB_OUT_DAMAGE,
".$sPrefix."JOB_OUTCOME.ACCESS_LEVEL_ID AS JOB_OUT_ACCESS_ID,
".$sPrefix."JOB_OUTCOME.AVAILABLE_ID AS JOB_OUT_AVAIL_ID
FROM
".$sPrefix."JOB_OUTCOME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_OUTCOME_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_TIME_EDIT AS
SELECT
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_ID AS JOB_PIT_ID,
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_PIT AS JOB_PIT_PAYMENT,
".$sPrefix."JOB_INCOME_TIME.JOB_INCOME_TIME_Date AS JOB_PIT_DATA,
".$sPrefix."JOB_INCOME_TIME.ACCESS_LEVEL_ID AS JOB_PIT_ACCESS_ID,
".$sPrefix."JOB_INCOME_TIME.AVAILABLE_ID AS JOB_PIT_AVAIL_ID
FROM
".$sPrefix."JOB_INCOME_TIME;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_TIME_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_SHAREHOLDER_EDIT AS
SELECT
".$sPrefix."SHAREHOLDER.SHAREHOLDER_ID AS SHARE_ID,
".$sPrefix."SHAREHOLDER.EMPLOYEE_ID AS EMP_ID,
".$sPrefix."SHAREHOLDER.ACCESS_LEVEL_ID AS SHARE_ACCESS_ID,
".$sPrefix."SHAREHOLDER.AVAILABLE_ID AS SHARE_AVAIL_ID
FROM
".$sPrefix."SHAREHOLDER;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_SHAREHOLDER_EDIT", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_LOGIN AS
SELECT
".$sPrefix."VIEW_EMPLOYEE.EMP_ID,
".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL,
".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PASS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS
FROM
".$sPrefix."VIEW_EMPLOYEE,
".$sPrefix."VIEW_EMPLOYEE_DATA
WHERE
(".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID
AND
".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_LOGIN", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_OVERVIEW AS
SELECT 
".$sPrefix."COMPANY.COMPANY_ID AS COMP_ID,
".$sPrefix."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS,
".$sPrefix."COMPANY.AVAILABLE_ID AS COMP_AVAIL,
".$sPrefix."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS,
".$sPrefix."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Title AS COMP_DATA_TITLE,
".$sPrefix."COMPANY_DATA.COMPANY_DATA_Date AS COMP_DATA_DATE,
".$sPrefix."COUNTY.ACCESS_LEVEL_ID AS COU_ACCESS,
".$sPrefix."COUNTY.AVAILABLE_ID AS COU_AVAIL,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Title AS COU_DATA_TITLE,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_Tax AS COU_DATA_TAX,
".$sPrefix."COUNTY_DATA.COUNTY_DATA_InterestRate AS COU_DATA_IR,
".$sPrefix."COUNTY_DATA.ACCESS_LEVEL_ID AS COU_DATA_ACCESS,
".$sPrefix."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL,
".$sPrefix."COUNTRY.ACCESS_LEVEL_ID AS COUN_ACCESS,
".$sPrefix."COUNTRY.AVAILABLE_ID AS COUN_AVAIL,
".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_Title AS COUN_DATA_TITLE,
".$sPrefix."COUNTRY_DATA.ACCESS_LEVEL_ID AS COUN_DATA_ACCESS,
".$sPrefix."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL
FROM 
".$sPrefix."COMPANY,
".$sPrefix."COMPANY_DATA,
".$sPrefix."COUNTY,
".$sPrefix."COUNTY_DATA,
".$sPrefix."COUNTRY,
".$sPrefix."COUNTRY_DATA
WHERE 
".$sPrefix."COMPANY.COMPANY_DATA_ID = ".$sPrefix."COMPANY_DATA.COMPANY_DATA_ID
AND
".$sPrefix."COMPANY.COUNTY_ID = ".$sPrefix."COUNTY.COUNTY_ID
AND
".$sPrefix."COUNTY.COUNTY_DATA_ID = ".$sPrefix."COUNTY_DATA.COUNTY_DATA_ID
AND
".$sPrefix."COUNTY.COUNTRY_ID = ".$sPrefix."COUNTRY.COUNTRY_ID
AND
".$sPrefix."COUNTRY.COUNTRY_DATA_ID = ".$sPrefix."COUNTRY_DATA.COUNTRY_DATA_ID;";

printf($sDBQuery);

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 25 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_OVERVIEW AS
SELECT
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_OVERVIEW AS
SELECT
".$sPrefix."VIEW_EMPLOYEE.EMP_ID,
".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL,
".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS
FROM
".$sPrefix."VIEW_EMPLOYEE,
".$sPrefix."VIEW_EMPLOYEE_DATA,
".$sPrefix."VIEW_EMPLOYEE_POSITION
WHERE
(".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID
AND
".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID = ".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_POSITION_OVERVIEW AS
SELECT
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS
FROM
".$sPrefix."VIEW_EMPLOYEE_POSITION;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_POSITION_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_OVERVIEW AS
SELECT 
".$sPrefix."VIEW_JOB.JOB_ID, 
".$sPrefix."VIEW_JOB.JOB_AVAIL,
".$sPrefix."VIEW_JOB.JOB_ACCESS, 
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_TITLE, 
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_DATE, 
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_AVAIL, 
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS, 
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PRICE, 
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PIA, 
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_AVAIL, 
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS, 
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_EXPENSES, 
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_DAMAGE, 
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_AVAIL, 
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS, 
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS, 
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL 
FROM 
".$sPrefix."VIEW_JOB, 
".$sPrefix."VIEW_JOB_DATA, 
".$sPrefix."VIEW_JOB_INCOME, 
".$sPrefix."VIEW_JOB_OUTCOME,
".$sPrefix."VIEW_COMPANY, 
".$sPrefix."VIEW_COMPANY_DATA 
WHERE 
(".$sPrefix."VIEW_JOB.JOB_DATA_ID = ".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ID 
 AND 
 ".$sPrefix."VIEW_JOB.JOB_INC_ID = ".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ID
 AND 
 ".$sPrefix."VIEW_JOB.JOB_OUT_ID = ".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID
 AND
 ".$sPrefix."VIEW_JOB.COMP_ID = ".$sPrefix."VIEW_COMPANY.COMP_ID 
 AND
 ".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_INCOME_TIME_SUM_AVAIL AS
SELECT
".$sPrefix."VIEW_JOB.JOB_ID,
SUM(".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_PAYMENT) AS JOB_PIT_SUM,
".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL,
".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS
FROM
".$sPrefix."VIEW_JOB,
".$sPrefix."VIEW_JOB_INCOME_TIME
WHERE
(".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = ".$_ENV['Available']['Show'].")
AND
(".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_ID = ".$sPrefix."VIEW_JOB.JOB_ID)
GROUP BY
(".$sPrefix."VIEW_JOB.JOB_ID)
ORDER BY
".$sPrefix."VIEW_JOB.JOB_ID ASC;";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_INCOME_TIME_SUM_AVAIL", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_SHAREHOLDER_OVERVIEW AS
SELECT
".$sPrefix."VIEW_SHAREHOLDER.SHARE_ID,
".$sPrefix."VIEW_SHAREHOLDER.SHARE_AVAIL,
".$sPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS
FROM
".$sPrefix."VIEW_SHAREHOLDER,
".$sPrefix."VIEW_EMPLOYEE,
".$sPrefix."VIEW_EMPLOYEE_DATA,
".$sPrefix."VIEW_EMPLOYEE_POSITION
WHERE
(".$sPrefix."VIEW_SHAREHOLDER.EMP_ID = ".$sPrefix."VIEW_EMPLOYEE.EMP_ID
AND
".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID
AND
".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID = ".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_SHAREHOLDER_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_OVERVIEW AS
SELECT
".$sPrefix."VIEW_CUSTOMER.CUST_ID,
".$sPrefix."VIEW_CUSTOMER.CUST_AVAIL,
".$sPrefix."VIEW_CUSTOMER.CUST_ACCESS,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NAME,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SURNAME,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_PN,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SN,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_EMAIL,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_VAT,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ADDR,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NOTE,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_AVAIL,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS
FROM
".$sPrefix."VIEW_CUSTOMER,
".$sPrefix."VIEW_CUSTOMER_DATA
WHERE
(".$sPrefix."VIEW_CUSTOMER.CUST_DATA_ID = ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_OVERVIEW AS
SELECT
".$sPrefix."VIEW_COUNTY.COU_ID,
".$sPrefix."VIEW_COUNTY.COU_AVAIL,
".$sPrefix."VIEW_COUNTY.COU_ACCESS,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS
FROM
".$sPrefix."VIEW_COUNTY,
".$sPrefix."VIEW_COUNTY_DATA
WHERE
(".$sPrefix."VIEW_COUNTY.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_OVERVIEW", $DBViewSuccMsg);
else
	printf("<br>ERROR 4 %s %s", $DBViewErrorMsg, $DBConn->GetError());

//WARNING: only use the tables below for development purposes.
//Always create view tables to do specific jobs or retrieving specific tables.
/*--------<VIEW GENERAL TABLES>--------*/
$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTRY_GENERAL AS
SELECT
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTRY_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 8 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COUNTY_GENERAL AS
SELECT
".$sPrefix."VIEW_COUNTY.COU_ID,
".$sPrefix."VIEW_COUNTY.COU_ACCESS,
".$sPrefix."VIEW_COUNTY.COU_AVAIL,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_COUNTY,
".$sPrefix."VIEW_COUNTY_DATA,
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_COUNTY.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID
AND
".$sPrefix."VIEW_COUNTRY.COUN_ID = ".$sPrefix."VIEW_COUNTY.COUN_ID
AND
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COUNTY_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 11 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_JOB_GENERAL AS
SELECT
".$sPrefix."VIEW_JOB.JOB_ID,
".$sPrefix."VIEW_JOB.JOB_ACCESS,
".$sPrefix."VIEW_JOB.JOB_AVAIL,
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ID,
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_TITLE,
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_DATE,
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS,
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_AVAIL,
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID,
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_EXPENSES,
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_DAMAGE,
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS,
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_AVAIL,
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ID,
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PRICE,
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_PIA,
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS,
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_AVAIL,
".$sPrefix."VIEW_COMPANY.COMP_ID,
".$sPrefix."VIEW_COMPANY.COMP_ACCESS,
".$sPrefix."VIEW_COMPANY.COMP_AVAIL,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL,
".$sPrefix."VIEW_COUNTY.COU_ID,
".$sPrefix."VIEW_COUNTY.COU_ACCESS,
".$sPrefix."VIEW_COUNTY.COU_AVAIL,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_JOB,
".$sPrefix."VIEW_JOB_DATA,
".$sPrefix."VIEW_JOB_OUTCOME,
".$sPrefix."VIEW_JOB_INCOME,
".$sPrefix."VIEW_COMPANY,
".$sPrefix."VIEW_COMPANY_DATA,
".$sPrefix."VIEW_COUNTY,
".$sPrefix."VIEW_COUNTY_DATA,
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID
AND 
".$sPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID = ".$sPrefix."VIEW_JOB.JOB_OUT_ID
AND 
".$sPrefix."VIEW_JOB_INCOME.JOB_INC_ID = ".$sPrefix."VIEW_JOB.JOB_INC_ID
AND 
".$sPrefix."VIEW_JOB_DATA.JOB_DATA_ID = ".$sPrefix."VIEW_JOB.JOB_DATA_ID
AND 
".$sPrefix."VIEW_JOB.COMP_ID = ".$sPrefix."VIEW_COMPANY.COMP_ID
AND
".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID
AND
".$sPrefix."VIEW_COUNTY.COU_ID = ".$sPrefix."VIEW_COMPANY.COU_ID
AND
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY.COU_DATA_ID
AND
".$sPrefix."VIEW_COUNTY.COUN_ID = ".$sPrefix."VIEW_COUNTRY.COUN_ID
AND
".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_JOB_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 18 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_CUSTOMER_GENERAL AS
SELECT
".$sPrefix."VIEW_CUSTOMER.CUST_ID,
".$sPrefix."VIEW_CUSTOMER.CUST_ACCESS,
".$sPrefix."VIEW_CUSTOMER.CUST_AVAIL,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ID,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NAME,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SURNAME,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_PN,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SN,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_EMAIL,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ADDR,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_VAT,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NOTE,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS,
".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_AVAIL
FROM
".$sPrefix."VIEW_CUSTOMER,
".$sPrefix."VIEW_CUSTOMER_DATA
WHERE
(".$sPrefix."VIEW_CUSTOMER.CUST_DATA_ID = ".$sPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_CUSTOMER_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 21 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_SHAREHOLDER_GENERAL AS
SELECT
".$sPrefix."VIEW_SHAREHOLDER.SHARE_ID,
".$sPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS,
".$sPrefix."VIEW_SHAREHOLDER.SHARE_AVAIL,
".$sPrefix."VIEW_EMPLOYEE.EMP_ID,
".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
".$sPrefix."VIEW_COMPANY.COMP_ID,
".$sPrefix."VIEW_COMPANY.COMP_ACCESS,
".$sPrefix."VIEW_COMPANY.COMP_AVAIL,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL,
".$sPrefix."VIEW_COUNTY.COU_ID,
".$sPrefix."VIEW_COUNTY.COU_ACCESS,
".$sPrefix."VIEW_COUNTY.COU_AVAIL,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_SHAREHOLDER,
".$sPrefix."VIEW_EMPLOYEE,
".$sPrefix."VIEW_EMPLOYEE_DATA,
".$sPrefix."VIEW_EMPLOYEE_POSITION,
".$sPrefix."VIEW_COMPANY,
".$sPrefix."VIEW_COMPANY_DATA,
".$sPrefix."VIEW_COUNTY,
".$sPrefix."VIEW_COUNTY_DATA,
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_SHAREHOLDER.EMP_ID = ".$sPrefix."VIEW_EMPLOYEE.EMP_ID
AND
".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID = ".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID
AND
".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID
AND
".$sPrefix."VIEW_EMPLOYEE.COMP_ID = ".$sPrefix."VIEW_COMPANY.COMP_ID
AND
".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID
AND
".$sPrefix."VIEW_COMPANY.COU_ID = ".$sPrefix."VIEW_COUNTY.COU_ID
AND
".$sPrefix."VIEW_COUNTY.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID
AND
".$sPrefix."VIEW_COUNTY.COUN_ID = ".$sPrefix."VIEW_COUNTRY.COUN_ID
AND
".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_SHAREHOLDER_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 23 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_COMPANY_GENERAL AS
SELECT
".$sPrefix."VIEW_COMPANY.COMP_ID,
".$sPrefix."VIEW_COMPANY.COMP_ACCESS,
".$sPrefix."VIEW_COMPANY.COMP_AVAIL,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL,
".$sPrefix."VIEW_COUNTY.COU_ID,
".$sPrefix."VIEW_COUNTY.COU_ACCESS,
".$sPrefix."VIEW_COUNTY.COU_AVAIL,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_COMPANY,
".$sPrefix."VIEW_COMPANY_DATA,
".$sPrefix."VIEW_COUNTY,
".$sPrefix."VIEW_COUNTY_DATA,
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID
AND 
".$sPrefix."VIEW_COMPANY.COU_ID = ".$sPrefix."VIEW_COUNTY.COU_ID
AND
".$sPrefix."VIEW_COUNTY.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID
AND
".$sPrefix."VIEW_COUNTY.COUN_ID = ".$sPrefix."VIEW_COUNTRY.COUN_ID
AND
".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_COMPANY_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 26 %s %s", $DBViewErrorMsg, $DBConn->GetError());

$sDBQuery="CREATE ALGORITHM = MERGE VIEW ".$sPrefix."VIEW_EMPLOYEE_GENERAL AS
SELECT
".$sPrefix."VIEW_EMPLOYEE.EMP_ID,
".$sPrefix."VIEW_EMPLOYEE.EMP_AVAIL,
".$sPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS,
".$sPrefix."VIEW_COMPANY.COMP_ID,
".$sPrefix."VIEW_COMPANY.COMP_ACCESS,
".$sPrefix."VIEW_COMPANY.COMP_AVAIL,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_DATE,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS,
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL,
".$sPrefix."VIEW_COUNTY.COU_ID,
".$sPrefix."VIEW_COUNTY.COU_ACCESS,
".$sPrefix."VIEW_COUNTY.COU_AVAIL,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS,
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
".$sPrefix."VIEW_COUNTRY.COUN_ID,
".$sPrefix."VIEW_COUNTRY.COUN_ACCESS,
".$sPrefix."VIEW_COUNTRY.COUN_AVAIL,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
FROM
".$sPrefix."VIEW_EMPLOYEE,
".$sPrefix."VIEW_EMPLOYEE_DATA,
".$sPrefix."VIEW_EMPLOYEE_POSITION,
".$sPrefix."VIEW_COMPANY,
".$sPrefix."VIEW_COMPANY_DATA,
".$sPrefix."VIEW_COUNTY,
".$sPrefix."VIEW_COUNTY_DATA,
".$sPrefix."VIEW_COUNTRY,
".$sPrefix."VIEW_COUNTRY_DATA
WHERE
(".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID = ".$sPrefix."VIEW_EMPLOYEE.EMP_POS_ID
AND 
".$sPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID = ".$sPrefix."VIEW_EMPLOYEE.EMP_DATA_ID
AND
".$sPrefix."VIEW_COMPANY.COMP_ID = ".$sPrefix."VIEW_EMPLOYEE.COMP_ID
AND
".$sPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID = ".$sPrefix."VIEW_COMPANY.COMP_ID
AND
".$sPrefix."VIEW_COUNTY.COU_ID = ".$sPrefix."VIEW_COMPANY.COU_ID
AND
".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY.COU_DATA_ID
AND
".$sPrefix."VIEW_COUNTY.COUN_ID = ".$sPrefix."VIEW_COUNTRY.COUN_ID
AND
".$sPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$sPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

$DBConn->ExecQuery($sDBQuery);

if(!$DBConn->HasError())
	printf("<br>%s -> VIEW_EMPLOYEE_GENERAL", $DBViewSuccMsg);
else
	printf("<br>ERROR 5 %s %s", $DBViewErrorMsg, $DBConn->GetError());
?>