<?php
printf("<!DOCTYPE html>");
printf("<html>");
printf("<head>");
printf("<meta charset=utf8>");
printf("</head>");
printf("</html>");
header("Content-Type: text/html; charset='utf-8'");

$ServerName = "localhost";
$DBUserName = "root";
$DBPassWord = "";

$DBQuery = "";

/*----Table created in database*/

$DBConn = new mysqli($ServerName, $DBUserName, $DBPassWord);

if($DBConn->connect_error)
	die("<br>ERROR 1 - Connection Failed: " . $DBConn->connect_error);
else
	printf("<br>Connection Succesfull");

//mysql_set_charset("utf8",$DBConn);

$DBQuery = "DROP DATABASE IF EXISTS CompanyAccountDB;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Droped Database successfully");
else
	printf("<br>ERROR 2 - Error droping database: " . $DBConn->error);

$DBQuery = "CREATE DATABASE CompanyAccountDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Database created successfully");
else
	printf("<br>ERROR 3 - Error creating database: " . $DBConn->error);

$DBQuery = "USE CompanyAccountDB;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>successfully use database");
else
	printf("<br>ERROR 4 - Failed to use database: " . $DBConn->error);

$DBQuery = "CREATE TABLE IF NOT EXISTS AVAILABLE
(
	AVAILABLE_ID INT AUTO_INCREMENT,
	AVAILABLE_Deleted BOOLEAN NOT NULL DEFAULT FALSE,
	AVAILABLE_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	PRIMARY KEY(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 5 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS ACCESS_LEVEL
(
	ACCESS_LEVEL_ID INT AUTO_INCREMENT,
	ACCESS_LEVEL_Title VARCHAR(32) NOT NULL,
	ACCESS_LEVEL_Clearance INT NOT NULL,
	ACCESS_LEVEL_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 6 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS COUNTRY_DATA
(
	COUNTRY_DATA_ID INT AUTO_INCREMENT,
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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 7 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS COUNTRY
(
	COUNTRY_ID INT AUTO_INCREMENT,
	COUNTRY_Title varchar(64) NOT NULL DEFAULT 0,
	COUNTRY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COUNTRY_DATA_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COUNTRY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_DATA_ID) REFERENCES COUNTRY_DATA(COUNTRY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 8 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS COMPANY_DATA
(
	COMPANY_DATA_ID INT AUTO_INCREMENT,
	COMPANY_DATA_Title varchar(64) NOT NULL DEFAULT 0,
	COMPANY_DATA_Date DATE NOT NULL,
	COMPANY_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COMPANY_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 9 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS COMPANY
(
	COMPANY_ID INT AUTO_INCREMENT,
	COMPANY_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	COUNTRY_ID INT NOT NULL,
	COMPANY_DATA_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(COMPANY_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(COUNTRY_ID) REFERENCES COUNTRY(COUNTRY_ID),
	FOREIGN KEY(COMPANY_DATA_ID) REFERENCES COMPANY_DATA(COMPANY_DATA_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 10 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS EMPLOYEE_POSITION
(
	EMPLOYEE_POSITION_ID INT AUTO_INCREMENT,
	EMPLOYEE_POSITION_Title varchar(64) NOT NULL,
	EMPLOYEE_POSITION_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_POSITION_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 11 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS EMPLOYEE_DATA
(
	EMPLOYEE_DATA_ID INT AUTO_INCREMENT,
	EMPLOYEE_DATA_Salary DECIMAL(65,2) NOT NULL,
	EMPLOYEE_DATA_BDay DATE NOT NULL,
	EMPLOYEE_DATA_Name VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_PassWord VARCHAR(64) NOT NULL COLLATE utf8_unicode_ci,
	EMPLOYEE_DATA_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(EMPLOYEE_DATA_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 12 - Error creating table: " . $DBConn->error);

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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 13 - Error creating table: " . $DBConn->error);

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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 14 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS JOB_INCOME_IN_TIME
(
	JOB_INCOME_IN_TIME_ID INT AUTO_INCREMENT,
	JOB_INCOME_IN_TIME_Payment DECIMAL(65,2) NOT NULL,
	JOB_INCOME_IN_TIME_CDate TIMESTAMP NOT NULL,
	ACCESS_LEVEL_ID INT NOT NULL,
	JOB_INCOME_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_INCOME_IN_TIME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(JOB_INCOME_ID) REFERENCES JOB_INCOME(JOB_INCOME_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 15 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS JOB_OUTCOME
(
	JOB_OUTCOME_ID INT AUTO_INCREMENT,
	JOB_OUTCOME_Expences DECIMAL(65,2) NOT NULL DEFAULT 0,
	JOB_OUTCOME_Damage DECIMAL(65,2) NOT NULL DEFAULT 0,
	JOB_OUTCOME_CDate TIMESTAMP NOT NULL DEFAULT NOW(),
	ACCESS_LEVEL_ID INT NOT NULL,
	AVAILABLE_ID INT NOT NULL,
	PRIMARY KEY(JOB_OUTCOME_ID),
	FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ACCESS_LEVEL(ACCESS_LEVEL_ID),
	FOREIGN KEY(AVAILABLE_ID) REFERENCES AVAILABLE(AVAILABLE_ID)
)ENGINE=innoDB COLLATE utf8_unicode_ci;";

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 16 - Error creating table: " . $DBConn->error);

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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 17 - Error creating table: " . $DBConn->error);

$DBQuery="CREATE TABLE IF NOT EXISTS JOB
(
	JOB_ID INT AUTO_INCREMENT,
	JOB_Title VARCHAR(64) NOT NULL,
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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 18 - Error creating table: " . $DBConn->error);

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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 19 - Error creating table: " . $DBConn->error);

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

if($DBConn->query($DBQuery) === TRUE)
	printf("<br>Table successfuly created");
else
	printf("<br>ERROR 20 - Error creating table: " . $DBConn->error);

/*----Data inserted in tables*/

$DBConn->autocommit(FALSE);

$DBQuery="INSERT INTO AVAILABLE(AVAILABLE_Deleted) VALUES
(TRUE),
(FALSE);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 21.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 21 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO ACCESS_LEVEL(ACCESS_LEVEL_Title, ACCESS_LEVEL_Clearance, AVAILABLE_ID) VALUES
(\"Admin\",1,2),
(\"CEO\",2,2),
(\"Employee\",3,2),
(\"Guest\",4,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 22.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 22 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO COUNTRY_DATA(COUNTRY_DATA_Tax, COUNTRY_DATA_InterestRate, COUNTRY_DATA_Date, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(29.0000, 3.0000, \"2017-1-1\",2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 23.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 23 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO COUNTRY(COUNTRY_Title, COUNTRY_DATA_ID, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(\"Greece\", 1, 2, 2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 24.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 24 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO COMPANY_DATA(COMPANY_DATA_Title, COMPANY_DATA_Date, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(\"Focus Studio\",\"1995-1-1\",2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 25.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 25 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO COMPANY(COUNTRY_ID, COMPANY_DATA_ID, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(1,1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 26.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 26 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO EMPLOYEE_POSITION(EMPLOYEE_POSITION_Title, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
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
		printf("<br>--ERROR 27.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 27 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO EMPLOYEE_DATA(EMPLOYEE_DATA_Salary, EMPLOYEE_DATA_BDay, EMPLOYEE_DATA_Name, EMPLOYEE_DATA_PassWord, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(0,\"1970-1-1\",\"Mixalis Varkaris\",\"BarkarisPass\",3,2),
(0,\"1970-1-1\",\"Andreas Apessos\",\"ApessosPass\",2,2),
(0,\"1970-1-1\",\"Jonas-Charles Apessos-MCdonald\",\"Apessos2Pass\",1,2);";

//$DBQuery=mb_convert_encoding($DBQuery, "UTF-8", "auto");

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 28.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 28 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO EMPLOYEE(EMPLOYEE_POSITION_ID, EMPLOYEE_DATA_ID, COMPANY_ID, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(7,1,1,2,2),
(1,2,1,2,2),
(20,3,1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 29.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 29 - Error inserting data into table: " . $DBConn->error);

$DBQuery="INSERT INTO SHAREHOLDER(EMPLOYEE_ID, ACCESS_LEVEL_ID, AVAILABLE_ID) VALUES
(2,2,2),
(1,2,2);";

if($DBConn->query($DBQuery) === TRUE)
{
	printf("<br>successfuly inserted data");
	if(!$DBConn->commit())
		printf("<br>--ERROR 30.1 - Failed to commit transaction");
}
else
	printf("<br>ERROR 30 - Error inserting data into table: " . $DBConn->error);

$DBConn->close();
?>
