<?php
printf("<!DOCTYPE html>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("</head>");
printf("</html>");
header("Content-Type: text/html; charset='UTF-8'");

require("../Site/DBConnData.php");
require("../Site/DebugLogComMessage/DBErrorMsg.php");
require("../Site/DebugLogComMessage/DBWarnMsg.php");
require("../Site/DebugLogComMessage/DBSuccMsg.php");
require("../Site/DBConnManager.php");

$DBQuery = "";

$DBConn = new DBConnManager($_SERVER['ServerName'], $_SERVER['DBUserName'], $_SERVER['DBPassWord'], $_SERVER['ConnEncoding']);

/*----Table created in database*/
/*--------<CONNECT TO DATABASE>--------*/
if($DBConn->HasWarning())
	printf("<br>WARNING: while establishing connection: " . $DBConn->GetWarning());

/*--------<DROP EXISTING DATABASE>--------*/
$DBQuery = "DROP DATABASE IF EXISTS " . $_SERVER['DBName'];

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
$DBQuery = "CREATE DATABASE CompanyAccountDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>Database created successfully");

	if($DBConn->HasWarning())
		printf("<br>WARNING: while creating database" . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 2 - Error creating database: " . $DBConn->GetError());

$DBQuery = "USE " . $_SERVER['DBName'] . ";";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
	printf("<br>successfully use database");
else
	printf("<br>ERROR 3 - Failed to use database: " . $DBConn->GetError());

/*--------<CREATE TABLE AVAILABLE>--------*/
$DBQuery = "CREATE TABLE IF NOT EXISTS AVAILABLE
(
	AVAILABLE_ID INT AUTO_INCREMENT,
	AVAILABLE_Deleted BOOLEAN NOT NULL DEFAULT FALSE,
	AVAILABLE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " AVAILABLE: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 4 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE ACCESS_LEVEL>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS ACCESS_LEVEL
(
	ACCESS_LEVEL_ID INT AUTO_INCREMENT,
	ACCESS_LEVEL_Title VARCHAR(32) NOT NULL COLLATE utf8_unicode_ci,
	ACCESS_LEVEL_Clearance INT NOT NULL,
	ACCESS_LEVEL_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " ACCESS_LEVEL: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 5 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COUNTRY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS COUNTRY_DATA
(
	COUNTRY_DATA_ID INT AUTO_INCREMENT,
	COUNTRY_DATA_Title varchar(64) NOT NULL COLLATE utf8_unicode_ci,
	COUNTRY_DATA_Tax DECIMAL(8,4) NOT NULL DEFAULT 0,
	COUNTRY_DATA_InterestRate DECIMAL(8,4) NOT NULL DEFAULT 0,
	COUNTRY_DATA_Date DATE NOT NULL,
	COUNTRY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTRY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COUNTRY_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 6 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COUNTRY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS COUNTRY
(
	COUNTRY_ID INT AUTO_INCREMENT,
	COUNTRY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COUNTRY_DATA_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTRY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_DATA_ID) REFERENCES COUNTRY_DATA(COUNTRY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COUNTRY: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 7 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COMPANY_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS COMPANY_DATA
(
	COMPANY_DATA_ID INT AUTO_INCREMENT,
	COMPANY_DATA_Title varchar(64) NOT NULL COLLATE utf8_unicode_ci,
	COMPANY_DATA_Date DATE NOT NULL,
	COMPANY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COUNTRY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COMPANY_DATA_ID),
	FOREIGN KEY(COUNTRY_ID) REFERENCES COUNTRY(COUNTRY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COMPANY_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 8 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE COMPANY>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS COMPANY
(
	COMPANY_ID INT AUTO_INCREMENT,
	COMPANY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COMPANY_DATA_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COMPANY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COMPANY_DATA_ID) REFERENCES COMPANY_DATA(COMPANY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " COMPANY: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 9 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE_POSITION>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS EMPLOYEE_POSITION
(
	EMPLOYEE_POSITION_ID INT AUTO_INCREMENT,
	EMPLOYEE_POSITION_Title varchar(64) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_POSITION_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " EMPLOYEE_POSITION: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 10 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS EMPLOYEE_DATA
(
	EMPLOYEE_DATA_ID INT AUTO_INCREMENT,
	EMPLOYEE_DATA_Salary DECIMAL(65,2) NOT NULL,
	EMPLOYEE_DATA_BDay DATE NOT NULL,
	EMPLOYEE_DATA_Email VARCHAR(128) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_Name VARCHAR(64) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_PassWord VARCHAR(255) NOT NULL UNIQUE COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " EMPLOYEE_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 11 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE EMPLOYEE>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS EMPLOYEE
(
	EMPLOYEE_ID INT AUTO_INCREMENT,
	EMPLOYEE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	EMPLOYEE_POSITION_ID INT NOT NULL,
	EMPLOYEE_DATA_ID INT NOT NULL,
	COMPANY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_POSITION_ID) REFERENCES EMPLOYEE_POSITION(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(EMPLOYEE_DATA_ID) REFERENCES EMPLOYEE_DATA(EMPLOYEE_DATA_ID),
	FOREIGN KEY(COMPANY_ID) REFERENCES COMPANY(COMPANY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " EMPLOYEE: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 12 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_INCOME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS JOB_INCOME
(
	JOB_INCOME_ID INT AUTO_INCREMENT,
	JOB_INCOME_Price DECIMAL(65,2) NOT NULL DEFAULT 0,
	JOB_INCOME_PIA DECIMAL(65,2) NOT NULL DEFAULT 0,
	JOB_INCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_INCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_INCOME " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 13 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_INCOME_IN_TIME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS JOB_INCOME_TIME
(
	JOB_INCOME_TIME_ID INT AUTO_INCREMENT,
	JOB_INCOME_TIME_PIT DECIMAL(65,2) NOT NULL,
	JOB_INCOME_TIME_Date DATE NOT NULL,
	JOB_INCOME_TIME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	JOB_INCOME_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_INCOME_TIME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_INCOME_ID) REFERENCES JOB_INCOME(JOB_INCOME_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_INCOME_TIME: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 14 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_OUTCOME>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS JOB_OUTCOME
(
	JOB_OUTCOME_ID INT AUTO_INCREMENT,
	JOB_OUTCOME_Expenses DECIMAL(65,2) NOT NULL DEFAULT 0,
	JOB_OUTCOME_Damage DECIMAL(65,2) NOT NULL DEFAULT 0,
	JOB_OUTCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_OUTCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_OUTCOME: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 15 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_DATA>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS JOB_DATA
(
	JOB_DATA_ID INT AUTO_INCREMENT,
	JOB_DATA_Date DATE NOT NULL,
	JOB_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	JOB_INCOME_ID INT NOT NULL,
	JOB_OUTCOME_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_INCOME_ID) REFERENCES JOB_INCOME(JOB_INCOME_ID),
	FOREIGN KEY(JOB_OUTCOME_ID) REFERENCES JOB_OUTCOME(JOB_OUTCOME_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_DATA: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 16 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS JOB
(
	JOB_ID INT AUTO_INCREMENT,
	JOB_Title VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	JOB_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	JOB_DATA_ID INT NOT NULL,
	COMPANY_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_DATA_ID) REFERENCES JOB_DATA(JOB_DATA_ID),
	FOREIGN KEY(COMPANY_ID) REFERENCES COMPANY(COMPANY_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 17 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE JOB_ASSIGMENT>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS JOB_ASSIGMENT
(
	JOB_ASSIGMENT_ID INT AUTO_INCREMENT,
	JOB_ASSIGMENT_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	EMPLOYEE_ID INT NOT NULL,
	JOB_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_ASSIGMENT_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_ID) REFERENCES EMPLOYEE(EMPLOYEE_ID),
	FOREIGN KEY(JOB_ID) REFERENCES JOB(JOB_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " JOB_ASSIGMENT: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 18 " . $DBTableErrorMsg . $DBConn->GetError());

/*--------<CREATE TABLE SHAREHOLDER>--------*/
$DBQuery="CREATE TABLE IF NOT EXISTS SHAREHOLDER
(
	SHAREHOLDER_ID INT AUTO_INCREMENT,
	SHAREHOLDER_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	EMPLOYEE_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(SHAREHOLDER_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(EMPLOYEE_ID) REFERENCES EMPLOYEE(EMPLOYEE_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

$DBConn->ExecQuery($DBQuery);

if(!$DBConn->HasError())
{
	printf("<br>" . $DBTableSuccCreaMsg);

	if($DBConn->HasWarning())
		printf("<br>" . $DBTableWarmMsg . " SHAREHOLDER: " . $DBConn->GetWarning());
}
else
	printf("<br>ERROR 19 " . $DBTableErrorMsg . $DBConn->GetError());

require("ViewTables.php");
require("DemoData.php");

$DBConn->closeConn();
?>
