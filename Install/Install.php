<?php
require_once("../Site/Data/HeaderData/HeaderData.php");

session_start();

require_once("../Site/Data/GlobalData.php");
require_once("../Site/Data/ConnData/DBConnData.php");
require_once("DebugLogComMessage/DBErrorMsg.php");
require_once("DebugLogComMessage/DBWarnMsg.php");
require_once("DebugLogComMessage/DBSuccMsg.php");
require_once("../MedaLib/Class/Manager/DBConnManager.php");

printf("<!DOCTYPE html>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("</head>");

printf("<body>");

$DBQuery = "";
$ServerName = $_SESSION['ServerName'];
$DBName = $_SESSION['DBName'];
$DBUsername = $_SESSION['DBUsername'];
$DBPassword = $_SESSION['DBPassword'];
$Encoding = $_SESSION['DBPrefix'];

$DBConn = new CDBConnManager($ServerName, $DBName, $DBUsername, $DBPassword, $Encoding);

/*----Table created in database*/
/*--------<CONNECT TO DATABASE>--------*/
if($DBConn->HasWarning())
	printf("<br>WARNING: while establishing connection: " . $DBConn->GetWarning());

/*--------<DROP EXISTING DATABASE>--------*/
$DBQuery = "DROP DATABASE IF EXISTS " . $DBConn->GetPrefix() . $DBConn->GetDBName();

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>Droped Database successfully");

	if($DBConn->HasWarning())
		printf("<br>WARNING: while droping database" . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 1 - Error droping database: " . $DBConn->GetError());

/*--------<CREATE DATABASE>--------*/
$DBQuery = "CREATE DATABASE ".$DBConn->GetPrefix()."CompanyAccountDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>Database created successfully");

	if($DBConn->HasWarning())
		printf("<br>WARNING: while creating database" . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 2 - Error creating database: " . $DBConn->GetError());

$DBQuery = "USE " . $DBConn->GetPrefix() . $_SESSION['DBName'] . ";";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>successfully use database");
else
	printf("<br>ERROR 3 - Failed to use database: " . $DBConn->GetError());

printf("<br><h1>TABLES</h1><br>");

/*--------<CREATE TABLE AVAILABLE>--------*/
$DBQuery = "CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."AVAILABLE
(
	AVAILABLE_ID INT AUTO_INCREMENT,
	AVAILABLE_Deleted BOOLEAN NOT NULL DEFAULT FALSE,
	AVAILABLE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> AVAILABLE");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " AVAILABLE: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 4 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE ACCESS_LEVEL>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."ACCESS_LEVEL
(
	ACCESS_LEVEL_ID INT AUTO_INCREMENT,
	ACCESS_LEVEL_Title VARCHAR(32) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	ACCESS_LEVEL_Clearance INT NOT NULL,
	ACCESS_LEVEL_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> ACCESS_LEVEL");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " ACCESS_LEVEL: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 5 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COUNTRY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."COUNTRY_DATA
(
	COUNTRY_DATA_ID INT AUTO_INCREMENT,
	COUNTRY_DATA_Title varchar(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	COUNTRY_DATA_Date TIMESTAMP NOT NULL DEFAULT NOW(),
	COUNTRY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTRY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> COUNTRY_DATA");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COUNTRY_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 6 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COUNTRY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."COUNTRY
(
	COUNTRY_ID INT AUTO_INCREMENT,
	COUNTRY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COUNTRY_DATA_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTRY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_DATA_ID) REFERENCES ".$DBConn->GetPrefix()."COUNTRY_DATA(COUNTRY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> COUNTRY");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COUNTRY: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 7 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COUNTY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."COUNTY_DATA
(
	COUNTY_DATA_ID INT AUTO_INCREMENT,
	COUNTY_DATA_Title VARCHAR(32) NOT NULL,
	COUNTY_DATA_Tax DECIMAL(8,4) NOT NULL DEFAULT 0,
	COUNTY_DATA_InterestRate DECIMAL(8,4) NOT NULL DEFAULT 0,
	COUNTY_DATA_Date DATE NOT NULL,
	COUNTY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> COUNTRY");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COUNTRY: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 8 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COUNTY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."COUNTY
(
	COUNTY_ID INT AUTO_INCREMENT,
	COUNTY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COUNTRY_ID INT NOT NULL,
	COUNTY_DATA_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_ID) REFERENCES ".$DBConn->GetPrefix()."COUNTRY(COUNTRY_ID),
	FOREIGN KEY(COUNTY_DATA_ID) REFERENCES ".$DBConn->GetPrefix()."COUNTY_DATA(COUNTY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> COUNTY");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COUNTY: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 9 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COMPANY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."COMPANY_DATA
(
	COMPANY_DATA_ID INT AUTO_INCREMENT,
	COMPANY_DATA_Title varchar(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	COMPANY_DATA_Date DATE NOT NULL,
	COMPANY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COMPANY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> COMPANY_DATA");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COMPANY_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 10 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COMPANY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."COMPANY
(
	COMPANY_ID INT AUTO_INCREMENT,
	COMPANY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COMPANY_DATA_ID INT NOT NULL,
	COUNTY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COMPANY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COMPANY_DATA_ID) REFERENCES ".$DBConn->GetPrefix()."COMPANY_DATA(COMPANY_DATA_ID),
	FOREIGN KEY(COUNTY_ID) REFERENCES ".$DBConn->GetPrefix()."COUNTY(COUNTY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> COMPANY");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COMPANY: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 11 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE_POSITION>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."EMPLOYEE_POSITION
(
	EMPLOYEE_POSITION_ID INT AUTO_INCREMENT,
	EMPLOYEE_POSITION_Title varchar(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_POSITION_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> EMPLOYEE_POSITION");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " EMPLOYEE_POSITION: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 12 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."EMPLOYEE_DATA
(
	EMPLOYEE_DATA_ID INT AUTO_INCREMENT,
	EMPLOYEE_DATA_Salary DECIMAL(65,2) NOT NULL,
	EMPLOYEE_DATA_BDay DATE NOT NULL,
	EMPLOYEE_DATA_PN VARCHAR(16) NOT NULL DEFAULT \"No\" COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_SN VARCHAR(16) NOT NULL DEFAULT \"No\" COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Email VARCHAR(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Name VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Surname VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_PassWord VARCHAR(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> EMPLOYEE_DATA");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " EMPLOYEE_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 13 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."EMPLOYEE
(
	EMPLOYEE_ID INT AUTO_INCREMENT,
	EMPLOYEE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	EMPLOYEE_POSITION_ID INT NOT NULL,
	EMPLOYEE_DATA_ID INT NOT NULL,
	COMPANY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_POSITION_ID) REFERENCES ".$DBConn->GetPrefix()."EMPLOYEE_POSITION(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(EMPLOYEE_DATA_ID) REFERENCES ".$DBConn->GetPrefix()."EMPLOYEE_DATA(EMPLOYEE_DATA_ID),
	FOREIGN KEY(COMPANY_ID) REFERENCES ".$DBConn->GetPrefix()."COMPANY(COMPANY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> EMPLOYEE");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " EMPLOYEE: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 14 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE CUSTOMER_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."CUSTOMER_DATA
(
	CUSTOMER_DATA_ID INT AUTO_INCREMENT,
	CUSTOMER_DATA_Name VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Surname VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_PN VARCHAR(16) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_SN VARCHAR(16) NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Email VARCHAR(64) NULL UNIQUE COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_VAT VARCHAR(64) NULL UNIQUE DEFAULT NULL COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Addr VARCHAR(128) NOT NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	CUSTOMER_DATA_Note VARCHAR(256) NOT NULL DEFAULT \"None\" COLLATE utf8_unicode_ci,
	AVAILABLE_ID INT NOT NULL,
	ACCESS_LEVEL_ID INT NOT NULL,
	CUSTOMER_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(CUSTOMER_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> CUSTOMER_DATA");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " CUSTOMER_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 15 " . $DBTableErrorMsg . $DBConn->GetError());

	/*--------<CREATE TABLE CUSTOMER>--------*/
	$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."CUSTOMER
	(
		CUSTOMER_ID INT AUTO_INCREMENT,
		CUSTOMER_DATA_ID INT NOT NULL,
		AVAILABLE_ID INT NOT NULL,
		ACCESS_LEVEL_ID INT NOT NULL,
		CUSTOMER_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
		PRIMARY KEY(CUSTOMER_ID),
		FOREIGN KEY(CUSTOMER_DATA_ID) REFERENCES ".$DBConn->GetPrefix()."CUSTOMER_DATA(CUSTOMER_DATA_ID),
		FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID),
		FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID)
	)ENGINE=innoDB COLLATE utf8_unicode_ci;";

	$DBConn->ExecQuery($DBQuery);

	if(!$DBConn->HasError())
	{
		printf("<br>" . $DBTableSuccCreaMsg . " -> CUSTOMER");

		if($DBConn->HasWarning())
			printf("<br>" . $DBTableWarmMsg . " CUSTOMER: " . $DBConn->GetWarning());
	}
	else
		printf("<br>ERROR 16 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_INCOME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."JOB_INCOME
(
	JOB_INCOME_ID INT AUTO_INCREMENT,
	JOB_INCOME_Price DECIMAL(65,2) NULL DEFAULT 0,
	JOB_INCOME_PIA DECIMAL(65,2) NULL DEFAULT 0,
	JOB_INCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_INCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> JOB_INCOME");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_INCOME " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 17 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_OUTCOME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."JOB_OUTCOME
(
	JOB_OUTCOME_ID INT AUTO_INCREMENT,
	JOB_OUTCOME_Expenses DECIMAL(65,2) NULL DEFAULT 0,
	JOB_OUTCOME_Damage DECIMAL(65,2) NULL DEFAULT 0,
	JOB_OUTCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_OUTCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> JOB_OUTCOME");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_OUTCOME: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 18 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."JOB_DATA
(
	JOB_DATA_ID INT AUTO_INCREMENT,
	JOB_DATA_Title VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	JOB_DATA_Date DATE NOT NULL,
	JOB_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> JOB_DATA");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 19 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."JOB
(
	JOB_ID INT AUTO_INCREMENT,
	JOB_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	JOB_DATA_ID INT NOT NULL,
	JOB_INCOME_ID INT NOT NULL,
	JOB_OUTCOME_ID INT NOT NULL,
	COMPANY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_DATA_ID) REFERENCES ".$DBConn->GetPrefix()."JOB_DATA(JOB_DATA_ID),
	FOREIGN KEY(JOB_INCOME_ID) REFERENCES ".$DBConn->GetPrefix()."JOB_INCOME(JOB_INCOME_ID),
	FOREIGN KEY(JOB_OUTCOME_ID) REFERENCES ".$DBConn->GetPrefix()."JOB_OUTCOME(JOB_OUTCOME_ID),
	FOREIGN KEY(COMPANY_ID) REFERENCES ".$DBConn->GetPrefix()."COMPANY(COMPANY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> JOB");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 20 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_INCOME_IN_TIME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."JOB_INCOME_TIME
(
	JOB_INCOME_TIME_ID INT AUTO_INCREMENT,
	JOB_INCOME_TIME_PIT DECIMAL(65,2) NULL DEFAULT 0,
	JOB_INCOME_TIME_Date DATE NOT NULL,
	JOB_INCOME_TIME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	JOB_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_INCOME_TIME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_ID) REFERENCES ".$DBConn->GetPrefix()."JOB(JOB_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> JOB_INCOME_TIME");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_INCOME_TIME: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 21 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_ASSIGMENT>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."JOB_ASSIGMENT
(
	JOB_ASSIGMENT_ID INT AUTO_INCREMENT,
	JOB_ASSIGMENT_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	EMPLOYEE_ID INT NOT NULL,
	JOB_ID INT NOT NULL,
	CUSTOMER_ID INT NOT NULL,
	COUNTY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_ASSIGMENT_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_ID) REFERENCES ".$DBConn->GetPrefix()."EMPLOYEE(EMPLOYEE_ID),
	FOREIGN KEY(JOB_ID) REFERENCES ".$DBConn->GetPrefix()."JOB(JOB_ID),
	FOREIGN KEY(CUSTOMER_ID) REFERENCES ".$DBConn->GetPrefix()."CUSTOMER(CUSTOMER_ID),
	FOREIGN KEY(COUNTY_ID) REFERENCES ".$DBConn->GetPrefix()."COUNTY(COUNTY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> JOB_ASSIGMENT");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_ASSIGMENT: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 22 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE SHAREHOLDER>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ".$DBConn->GetPrefix()."SHAREHOLDER
(
	SHAREHOLDER_ID INT AUTO_INCREMENT,
	SHAREHOLDER_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	EMPLOYEE_ID INT NOT NULL UNIQUE,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(SHAREHOLDER_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$DBConn->GetPrefix()."ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_ID) REFERENCES ".$DBConn->GetPrefix()."EMPLOYEE(EMPLOYEE_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$DBConn->GetPrefix()."AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg . " -> SHAREHOLDER");

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " SHAREHOLDER: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 23 " . $DBTableErrorMsg . $DBConn->GetError());

require_once("ViewTables.php");
require_once("EssentialData.php");

printf("<br>");

if(session_unset())
	printf("<br>Session Nullified");
else
	printf("<br>Failed to Nullified sessions");

if(session_destroy())
	printf("<br>Destroy session");
else
	printf("<br>Failed to Destroy session");

$DBConn->CloseConn();

unset($DBQuery);
unset($DBConn);

printf("</body>");

printf("</html>");
?>
