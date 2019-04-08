<?php
require_once("../Site/Data/HeaderData/HeaderData.php");

session_start();

require_once("../Site/Data/GlobalData.php");
require_once("../Site/Data/ConnData/DBConnData.php");
require_once("DebugLogComMessage/DBErrorMsg.php");
require_once("DebugLogComMessage/DBWarnMsg.php");
require_once("DebugLogComMessage/DBSuccMsg.php");
require_once("../MedaLib/Class/Manager/DBConnManager.php");

print("<!DOCTYPE html>");
print("<html>");
print("<head>");
print("<meta charset=utf8>");
print("</head>");

print("<body>");

$DBQuery = "";

$ServerName = $_SESSION['ServerName'];
$DBName = $_SESSION['DBName'];
$DBUsername = $_SESSION['DBUsername'];
$DBPassword = $_SESSION['DBPassword'];
$Encoding = $_SESSION['DBPrefix'];

$DBConn = new ME_CDBConnManager($ServerName, $DBName, $DBUsername, $DBPassword, $Encoding);

$sPrefix = $DBConn->GetPrefix();

/*----Table created in database*/
/*--------<CONNECT TO DATABASE>--------*/
if($DBConn->HasWarning())
	printf("<br>WARNING: while establishing connection: %s", $DBConn->GetWarning());

/*--------<DROP EXISTING DATABASE>--------*/
$DBQuery = "DROP DATABASE IF EXISTS " . $sPrefix . $DBConn->GetDBName();

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	print("<br>Droped Database successfully");

	if($DBConn->HasWarning())
		printf("<br>WARNING: while droping database %s", $DBConn->GetWarning());
}
else
	printf("<br>ERROR 1 - Error droping database: %s", $DBConn->GetError());

/*--------<CREATE DATABASE>--------*/
$DBQuery = "CREATE DATABASE ".$sPrefix."CompanyAccountDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	print("<br>Database created successfully");

	if($DBConn->HasWarning())
		printf("<br>WARNING: while creating database %s", $DBConn->GetWarning());
}
else
	printf("<br>ERROR 2 - Error creating database: %s", $DBConn->GetError());

$DBQuery = "USE " . $sPrefix . $_SESSION['DBName'] . ";";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	print("<br>successfully use database");
else
	printf("<br>ERROR 3 - Failed to use database: %s", $DBConn->GetError());

print("<br><h1>TABLES</h1><br>");

/*--------<CREATE TABLE AVAILABLE>--------*/
$DBQuery = "CREATE TABLE IF NOT EXISTS ".$sPrefix."AVAILABLE
(
	AVAILABLE_ID TINYINT(1) UNSIGNED AUTO_INCREMENT UNIQUE,
	AVAILABLE_Deleted BIT(1) NOT NULL DEFAULT FALSE,
	AVAILABLE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> AVAILABLE", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s AVAILABLE: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 4 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE ACCESS_LEVEL>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."ACCESS_LEVEL
(
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED AUTO_INCREMENT UNIQUE,
	ACCESS_LEVEL_Title VARCHAR(32) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	ACCESS_LEVEL_Clearance TINYINT(1) UNSIGNED UNIQUE NOT NULL,
	ACCESS_LEVEL_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> ACCESS_LEVEL", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s ACCESS_LEVEL: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 5 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE COUNTRY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."COUNTRY_DATA
(
	COUNTRY_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	COUNTRY_DATA_Title varchar(32) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	COUNTRY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(COUNTRY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> COUNTRY_DATA", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s COUNTRY_DATA: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 6 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE COUNTRY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."COUNTRY
(
	COUNTRY_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	COUNTRY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	COUNTRY_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(COUNTRY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_DATA_ID) REFERENCES ".$sPrefix."COUNTRY_DATA(COUNTRY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> COUNTRY", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s COUNTRY: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 7 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE COUNTY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."COUNTY_DATA
(
	COUNTY_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	COUNTY_DATA_Title VARCHAR(64) NOT NULL,
	COUNTY_DATA_Tax DECIMAL(8,4) NOT NULL DEFAULT 0,
	COUNTY_DATA_InterestRate DECIMAL(8,4) NOT NULL DEFAULT 0,
	COUNTY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(COUNTY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> COUNTRY", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s COUNTRY: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 8 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE COUNTY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."COUNTY
(
	COUNTY_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	COUNTY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	COUNTRY_ID BIGINT(8) UNSIGNED NOT NULL,
	COUNTY_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(COUNTY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_ID) REFERENCES ".$sPrefix."COUNTRY(COUNTRY_ID),
	FOREIGN KEY(COUNTY_DATA_ID) REFERENCES ".$sPrefix."COUNTY_DATA(COUNTY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> COUNTY", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s COUNTY: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 9 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE COMPANY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."COMPANY_DATA
(
	COMPANY_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	COMPANY_DATA_Title varchar(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	COMPANY_DATA_Date DATE NOT NULL,
	COMPANY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(COMPANY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> COMPANY_DATA", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s COMPANY_DATA: ", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 10 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE COMPANY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."COMPANY
(
	COMPANY_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	COMPANY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	COMPANY_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
	COUNTY_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(COMPANY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COMPANY_DATA_ID) REFERENCES ".$sPrefix."COMPANY_DATA(COMPANY_DATA_ID),
	FOREIGN KEY(COUNTY_ID) REFERENCES ".$sPrefix."COUNTY(COUNTY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> COMPANY", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s COMPANY: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 11 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE_POSITION>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."EMPLOYEE_POSITION
(
	EMPLOYEE_POSITION_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	EMPLOYEE_POSITION_Title varchar(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_POSITION_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> EMPLOYEE_POSITION", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s EMPLOYEE_POSITION: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 12 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."EMPLOYEE_DATA
(
	EMPLOYEE_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	EMPLOYEE_DATA_Salary DECIMAL(65,2) NOT NULL,
	EMPLOYEE_DATA_BDay DATE NOT NULL,
	EMPLOYEE_DATA_PN VARCHAR(16) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_SN VARCHAR(16) NOT NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Email VARCHAR(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Name VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Surname VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_PassWord VARCHAR(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(EMPLOYEE_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> EMPLOYEE_DATA", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s EMPLOYEE_DATA: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 13 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."EMPLOYEE
(
	EMPLOYEE_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	EMPLOYEE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	EMPLOYEE_POSITION_ID BIGINT(8) UNSIGNED NOT NULL,
	EMPLOYEE_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
	COMPANY_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(EMPLOYEE_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_POSITION_ID) REFERENCES ".$sPrefix."EMPLOYEE_POSITION(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(EMPLOYEE_DATA_ID) REFERENCES ".$sPrefix."EMPLOYEE_DATA(EMPLOYEE_DATA_ID),
	FOREIGN KEY(COMPANY_ID) REFERENCES ".$sPrefix."COMPANY(COMPANY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> EMPLOYEE", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s EMPLOYEE: ", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 14 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE CUSTOMER_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."CUSTOMER_DATA
(
	CUSTOMER_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	CUSTOMER_DATA_Name VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Surname VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_PN VARCHAR(16) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_SN VARCHAR(16) NOT NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Email VARCHAR(64) NULL UNIQUE COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_VAT VARCHAR(16) NULL UNIQUE COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Addr VARCHAR(256) NOT NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Note VARCHAR(256) NOT NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	CUSTOMER_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(CUSTOMER_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> CUSTOMER_DATA", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s CUSTOMER_DATA: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 15 %s %s", $DBTableErrorMsg, $DBConn->GetError());

	/*--------<CREATE TABLE CUSTOMER>--------*/
	$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."CUSTOMER
	(
		CUSTOMER_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
		CUSTOMER_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
		CUSTOMER_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
		ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
		AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
		PRIMARY KEY(CUSTOMER_ID),
		FOREIGN KEY(CUSTOMER_DATA_ID) REFERENCES ".$sPrefix."CUSTOMER_DATA(CUSTOMER_DATA_ID),
		FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID),
		FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID)
	)ENGINE=innoDB COLLATE utf8_unicode_ci;";

	$DBConn->ExecQuery($DBQuery);

	if(!$DBConn->HasError())
	{
		printf("<br>%s -> CUSTOMER", $DBTableSuccCreaMsg);

		if($DBConn->HasWarning())
			printf("<br>%s CUSTOMER: %s", $DBTableWarmMsg, $DBConn->GetWarning());
	}
	else
		printf("<br>ERROR 16 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE JOB_INCOME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."JOB_INCOME
(
	JOB_INCOME_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	JOB_INCOME_Price DECIMAL(65,2) NULL DEFAULT 0,
	JOB_INCOME_PIA DECIMAL(65,2) NULL DEFAULT 0,
	JOB_INCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(JOB_INCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> JOB_INCOME", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s JOB_INCOME %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 17 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE JOB_OUTCOME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."JOB_OUTCOME
(
	JOB_OUTCOME_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	JOB_OUTCOME_Expenses DECIMAL(65,2) NULL DEFAULT 0,
	JOB_OUTCOME_Damage DECIMAL(65,2) NULL DEFAULT 0,
	JOB_OUTCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(JOB_OUTCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> JOB_OUTCOME", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s JOB_OUTCOME: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 18 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE JOB_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."JOB_DATA
(
	JOB_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	JOB_DATA_Title VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	JOB_DATA_Date DATE NOT NULL,
	JOB_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(JOB_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> JOB_DATA", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s JOB_DATA: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 19 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE JOB>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."JOB
(
	JOB_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	JOB_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	JOB_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
	JOB_INCOME_ID BIGINT(8) UNSIGNED NOT NULL,
	JOB_OUTCOME_ID BIGINT(8) UNSIGNED NOT NULL,
	COMPANY_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(JOB_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_DATA_ID) REFERENCES ".$sPrefix."JOB_DATA(JOB_DATA_ID),
	FOREIGN KEY(JOB_INCOME_ID) REFERENCES ".$sPrefix."JOB_INCOME(JOB_INCOME_ID),
	FOREIGN KEY(JOB_OUTCOME_ID) REFERENCES ".$sPrefix."JOB_OUTCOME(JOB_OUTCOME_ID),
	FOREIGN KEY(COMPANY_ID) REFERENCES ".$sPrefix."COMPANY(COMPANY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> JOB", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s JOB: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 20 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE JOB_INCOME_IN_TIME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."JOB_INCOME_TIME
(
	JOB_INCOME_TIME_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	JOB_INCOME_TIME_PIT DECIMAL(65,2) NULL DEFAULT 0,
	JOB_INCOME_TIME_Date DATE NOT NULL,
	JOB_INCOME_TIME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	JOB_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(JOB_INCOME_TIME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_ID) REFERENCES ".$sPrefix."JOB(JOB_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> JOB_INCOME_TIME", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s JOB_INCOME_TIME: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 21 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE JOB_ASSIGMENT>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."JOB_ASSIGMENT
(
	JOB_ASSIGMENT_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	JOB_ASSIGMENT_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	EMPLOYEE_ID BIGINT(8) UNSIGNED NOT NULL,
	JOB_ID BIGINT(8) UNSIGNED NOT NULL,
	CUSTOMER_ID BIGINT(8) UNSIGNED NOT NULL,
	COUNTY_ID BIGINT(8) UNSIGNED NOT NULL,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(JOB_ASSIGMENT_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_ID) REFERENCES ".$sPrefix."EMPLOYEE(EMPLOYEE_ID),
	FOREIGN KEY(JOB_ID) REFERENCES ".$sPrefix."JOB(JOB_ID),
	FOREIGN KEY(CUSTOMER_ID) REFERENCES ".$sPrefix."CUSTOMER(CUSTOMER_ID),
	FOREIGN KEY(COUNTY_ID) REFERENCES ".$sPrefix."COUNTY(COUNTY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> JOB_ASSIGMENT", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s JOB_ASSIGMENT: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 22 %s %s", $DBTableErrorMsg, $DBConn->GetError());

/*--------<CREATE TABLE SHAREHOLDER>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$sPrefix."SHAREHOLDER
(
	SHAREHOLDER_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
	SHAREHOLDER_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	EMPLOYEE_ID BIGINT(8) UNSIGNED NOT NULL UNIQUE,
	ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
	AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
	PRIMARY KEY(SHAREHOLDER_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$sPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_ID) REFERENCES ".$sPrefix."EMPLOYEE(EMPLOYEE_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$sPrefix."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>%s -> SHAREHOLDER", $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>%s SHAREHOLDER: %s", $DBTableWarmMsg, $DBConn->GetWarning());
}
else
	printf("<br>ERROR 23 %s %s", $DBTableErrorMsg, $DBConn->GetError());

require_once("ViewTables.php");
require_once("EssentialData.php");

print("<br>");

if(session_unset())
	print("<br>Session Nullified");
else
	print("<br>Failed to Nullified sessions");

if(session_destroy())
	print("<br>Destroy session");
else
	print("<br>Failed to Destroy session");

unset($DBQuery);
unset($DBConn);

print("</body>");

print("</html>");
?>
