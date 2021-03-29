<?php
function StatementQueryCheck(mysqli_stmt &$InrStatement, string &$InsQuery, ME_CLogHandle &$InrLogHandle) : bool
{
    if(!$InrStatement->prepare($InsQuery))
        $InrLogHandle->AddLogMessage("Failed to create Statement", __FILE__, __FUNCTION__, __LINE__);
    else
    {
        if(!$InrStatement->execute())
            $InrLogHandle->AddLogMessage($InrStatement->errno . " - ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);
        else
            return TRUE;
    }

    return FALSE;
}

/*----Table created in database*/
function CreateTables(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrInstallationErrorLog, string &$InsPrefix, string &$InsDBName)
{
    
    /*--------<DROP EXISTING DATABASE>--------*/
    $sQuery = "DROP DATABASE IF EXISTS " . $InsPrefix . $InrConn->GetDBName();

    $rStatement = $InrConn->CreateStatement($sQuery);

    StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog);

    /*--------<CREATE DATABASE>--------*/
    $sQuery = "CREATE DATABASE ".$InsPrefix."CompanyAccountDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create Database", __FILE__, __FUNCTION__, __LINE__);


    //Select new database due to the deletion of the old one
    //This is to refresh the sync connection with the database after it was droped
    $InrConn->SetNewDBName($InsDBName);

    if($InrConn->bFailedToConnect)
    {
        $InrInstallationErrorLog->AddLogMessage("Error while connecting to the database connection", __FILE__, __FUNCTION__, __LINE__);

        exit("Failed to connect to new database, check in the error logs for more information");
    }

    /*--------<CREATE TABLE AVAILABLE>--------*/
    $sQuery = "CREATE TABLE IF NOT EXISTS ".$InsPrefix."AVAILABLE
    (
        AVAILABLE_ID TINYINT(1) UNSIGNED AUTO_INCREMENT UNIQUE,
        AVAILABLE_DELETED BIT(1) NOT NULL DEFAULT FALSE,
        AVAILABLE_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        PRIMARY KEY(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table AVAILABLE", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE ACCESS_LEVEL>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."ACCESS_LEVEL
    (
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED AUTO_INCREMENT UNIQUE,
        ACCESS_LEVEL_TITLE VARCHAR(32) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        ACCESS_LEVEL_CLEARANCE TINYINT(1) UNSIGNED UNIQUE NOT NULL,
        ACCESS_LEVEL_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table ACCESS_LEVEL", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE COUNTRY_DATA>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."COUNTRY_DATA
    (
        COUNTRY_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        COUNTRY_DATA_TITLE varchar(32) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        COUNTRY_DATA_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(COUNTRY_DATA_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table COUNTRY_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE COUNTRY>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."COUNTRY
    (
        COUNTRY_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        COUNTRY_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        COUNTRY_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(COUNTRY_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(COUNTRY_DATA_ID) REFERENCES ".$InsPrefix."COUNTRY_DATA(COUNTRY_DATA_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table COUNTRY", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE COUNTY_DATA>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."COUNTY_DATA
    (
        COUNTY_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        COUNTY_DATA_TITLE VARCHAR(64) NOT NULL,
        COUNTY_DATA_TAX DECIMAL(8,4) NOT NULL DEFAULT 0,
        COUNTY_DATA_INTEREST_RATE DECIMAL(8,4) NOT NULL DEFAULT 0,
        COUNTY_DATA_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(COUNTY_DATA_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table COUNTY_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE COUNTY>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."COUNTY
    (
        COUNTY_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        COUNTY_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        COUNTRY_ID BIGINT(8) UNSIGNED NOT NULL,
        COUNTY_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(COUNTY_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(COUNTRY_ID) REFERENCES ".$InsPrefix."COUNTRY(COUNTRY_ID),
        FOREIGN KEY(COUNTY_DATA_ID) REFERENCES ".$InsPrefix."COUNTY_DATA(COUNTY_DATA_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table COUNTY", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE COMPANY_DATA>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."COMPANY_DATA
    (
        COMPANY_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        COMPANY_DATA_TITLE varchar(64) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        COMPANY_DATA_DATE DATE NOT NULL,
        COMPANY_DATA_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(COMPANY_DATA_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table COMPANY_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE COMPANY>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."COMPANY
    (
        COMPANY_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        COMPANY_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        COMPANY_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
        COUNTY_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(COMPANY_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(COMPANY_DATA_ID) REFERENCES ".$InsPrefix."COMPANY_DATA(COMPANY_DATA_ID),
        FOREIGN KEY(COUNTY_ID) REFERENCES ".$InsPrefix."COUNTY(COUNTY_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table COMPANY", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE EMPLOYEE_POSITION>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."EMPLOYEE_POSITION
    (
        EMPLOYEE_POSITION_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        EMPLOYEE_POSITION_TITLE varchar(64) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_POSITION_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(EMPLOYEE_POSITION_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table EMPLOYEE_POSITION", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE EMPLOYEE_DATA>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."EMPLOYEE_DATA
    (
        EMPLOYEE_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        EMPLOYEE_DATA_SALARY DECIMAL(65,2) NOT NULL,
        EMPLOYEE_DATA_BDAY DATE NOT NULL,
        EMPLOYEE_DATA_PN VARCHAR(16) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_DATA_SN VARCHAR(16) NOT NULL DEFAULT \"None\" COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_DATA_EMAIL VARCHAR(64) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_DATA_NAME VARCHAR(32) NOT NULL COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_DATA_SURNAME VARCHAR(32) NOT NULL COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_DATA_PASSWORD VARCHAR(64) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        EMPLOYEE_DATA_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(EMPLOYEE_DATA_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table EMPLOYEE_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE EMPLOYEE>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."EMPLOYEE
    (
        EMPLOYEE_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        EMPLOYEE_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        EMPLOYEE_POSITION_ID BIGINT(8) UNSIGNED NOT NULL,
        EMPLOYEE_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
        COMPANY_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(EMPLOYEE_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(EMPLOYEE_POSITION_ID) REFERENCES ".$InsPrefix."EMPLOYEE_POSITION(EMPLOYEE_POSITION_ID),
        FOREIGN KEY(EMPLOYEE_DATA_ID) REFERENCES ".$InsPrefix."EMPLOYEE_DATA(EMPLOYEE_DATA_ID),
        FOREIGN KEY(COMPANY_ID) REFERENCES ".$InsPrefix."COMPANY(COMPANY_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table EMPLOYEE", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE CUSTOMER_DATA>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."CUSTOMER_DATA
    (
        CUSTOMER_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        CUSTOMER_DATA_NAME VARCHAR(32) NOT NULL COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_SURNAME VARCHAR(32) NOT NULL COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_PN VARCHAR(16) NOT NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_SN VARCHAR(16) NOT NULL DEFAULT \"None\" COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_EMAIL VARCHAR(64) NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_VAT VARCHAR(16) NULL UNIQUE COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_ADDR VARCHAR(256) NOT NULL DEFAULT \"None\" COLLATE utf8mb4_unicode_ci,
        CUSTOMER_DATA_NOTE VARCHAR(256) NOT NULL DEFAULT \"None\" COLLATE utf8mb4_unicode_ci,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        CUSTOMER_DATA_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        PRIMARY KEY(CUSTOMER_DATA_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table CUSTOMER_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE CUSTOMER>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."CUSTOMER
    (
        CUSTOMER_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        CUSTOMER_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
        CUSTOMER_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(CUSTOMER_ID),
        FOREIGN KEY(CUSTOMER_DATA_ID) REFERENCES ".$InsPrefix."CUSTOMER_DATA(CUSTOMER_DATA_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table CUSTOMER", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE JOB_INCOME>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."JOB_INCOME
    (
        JOB_INCOME_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        JOB_INCOME_PRICE DECIMAL(65,2) NULL DEFAULT 0,
        JOB_INCOME_PIA DECIMAL(65,2) NULL DEFAULT 0,
        JOB_INCOME_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(JOB_INCOME_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table JOB_INCOME", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE JOB_OUTCOME>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."JOB_OUTCOME
    (
        JOB_OUTCOME_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        JOB_OUTCOME_EXPENSES DECIMAL(65,2) NULL DEFAULT 0,
        JOB_OUTCOME_DAMAGE DECIMAL(65,2) NULL DEFAULT 0,
        JOB_OUTCOME_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(JOB_OUTCOME_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table JOB_OUTCOME", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE JOB_DATA>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."JOB_DATA
    (
        JOB_DATA_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        JOB_DATA_TITLE VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci,
        JOB_DATA_DATE DATE NOT NULL,
        JOB_DATA_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(JOB_DATA_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table JOB_DATA", __FILE__, __FUNCTION__, __LINE__);

    
    /*--------<CREATE TABLE JOB>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."JOB
    (
        JOB_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        JOB_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        JOB_DATA_ID BIGINT(8) UNSIGNED NOT NULL,
        JOB_INCOME_ID BIGINT(8) UNSIGNED NOT NULL,
        JOB_OUTCOME_ID BIGINT(8) UNSIGNED NOT NULL,
        COMPANY_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(JOB_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(JOB_DATA_ID) REFERENCES ".$InsPrefix."JOB_DATA(JOB_DATA_ID),
        FOREIGN KEY(JOB_INCOME_ID) REFERENCES ".$InsPrefix."JOB_INCOME(JOB_INCOME_ID),
        FOREIGN KEY(JOB_OUTCOME_ID) REFERENCES ".$InsPrefix."JOB_OUTCOME(JOB_OUTCOME_ID),
        FOREIGN KEY(COMPANY_ID) REFERENCES ".$InsPrefix."COMPANY(COMPANY_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table JOB", __FILE__, __FUNCTION__, __LINE__);

    
    /*--------<CREATE TABLE JOB_INCOME_IN_TIME>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."JOB_INCOME_TIME
    (
        JOB_INCOME_TIME_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        JOB_INCOME_TIME_PIT DECIMAL(65,2) NULL DEFAULT 0,
        JOB_INCOME_TIME_DATE DATE NOT NULL,
        JOB_INCOME_TIME_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        JOB_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(JOB_INCOME_TIME_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(JOB_ID) REFERENCES ".$InsPrefix."JOB(JOB_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table JOB_INCOME_TIME", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE JOB_ASSIGMENT>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."JOB_ASSIGMENT
    (
        JOB_ASSIGMENT_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        JOB_ASSIGMENT_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        EMPLOYEE_ID BIGINT(8) UNSIGNED NOT NULL,
        JOB_ID BIGINT(8) UNSIGNED NOT NULL,
        CUSTOMER_ID BIGINT(8) UNSIGNED NOT NULL,
        COUNTY_ID BIGINT(8) UNSIGNED NOT NULL,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(JOB_ASSIGMENT_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(EMPLOYEE_ID) REFERENCES ".$InsPrefix."EMPLOYEE(EMPLOYEE_ID),
        FOREIGN KEY(JOB_ID) REFERENCES ".$InsPrefix."JOB(JOB_ID),
        FOREIGN KEY(CUSTOMER_ID) REFERENCES ".$InsPrefix."CUSTOMER(CUSTOMER_ID),
        FOREIGN KEY(COUNTY_ID) REFERENCES ".$InsPrefix."COUNTY(COUNTY_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table JOB_ASSIGMENT", __FILE__, __FUNCTION__, __LINE__);


    /*--------<CREATE TABLE SHAREHOLDER>--------*/
    $sQuery="CREATE TABLE IF NOT EXISTS ".$InsPrefix."SHAREHOLDER
    (
        SHAREHOLDER_ID BIGINT(8) UNSIGNED AUTO_INCREMENT UNIQUE,
        SHAREHOLDER_CDATE TIMESTAMP NOT NULL DEFAULT NOW(),
        EMPLOYEE_ID BIGINT(8) UNSIGNED NOT NULL UNIQUE,
        ACCESS_LEVEL_ID TINYINT(1) UNSIGNED NOT NULL,
        AVAILABLE_ID TINYINT(1) UNSIGNED NOT NULL,
        PRIMARY KEY(SHAREHOLDER_ID),
        FOREIGN KEY(ACCESS_LEVEL_ID) REFERENCES ".$InsPrefix."ACCESS_LEVEL(ACCESS_LEVEL_ID),
        FOREIGN KEY(EMPLOYEE_ID) REFERENCES ".$InsPrefix."EMPLOYEE(EMPLOYEE_ID),
        FOREIGN KEY(AVAILABLE_ID) REFERENCES ".$InsPrefix."AVAILABLE(AVAILABLE_ID)
    )ENGINE=innoDB COLLATE utf8mb4_unicode_ci;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create table SHAREHOLDER", __FILE__, __FUNCTION__, __LINE__);

    $rStatement->close();
}
?>