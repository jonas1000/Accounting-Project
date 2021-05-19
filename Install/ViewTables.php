<?php
/*----Create view tables*/
function CreateViewTables(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrInstallationErrorLog, string &$InsPrefix)
{
    /*--------<VIEW ACCESS TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_ACCESS AS
    SELECT
    ACCESS_LEVEL_ID AS ACCESS_ID,
    ACCESS_LEVEL_TITLE AS ACCESS_TITLE,
    ACCESS_LEVEL_CLEARANCE AS ACCESS_LEVEL,
    AVAILABLE_ID AS ACCESS_AVAIL
    FROM
    ".$InsPrefix."ACCESS_LEVEL;";

    $rStatement = $InrConn->CreateStatement($sQuery);

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_ACCESS", __FILE__, __FUNCTION__, __LINE__);

    /*--------<VIEW EMPLOYEE TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE AS
    SELECT
    EMPLOYEE_ID AS EMP_ID,
    EMPLOYEE_POSITION_ID AS EMP_POS_ID,
    COMPANY_ID AS COMP_ID,
    EMPLOYEE_DATA_ID AS EMP_DATA_ID,
    AVAILABLE_ID AS EMP_AVAIL,
    ACCESS_LEVEL_ID AS EMP_ACCESS
    FROM
    ".$InsPrefix."EMPLOYEE;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_POSITION AS
    SELECT
    EMPLOYEE_POSITION_ID AS EMP_POS_ID,
    EMPLOYEE_POSITION_Title AS EMP_POS_TITLE,
    AVAILABLE_ID AS EMP_POS_AVAIL,
    ACCESS_LEVEL_ID AS EMP_POS_ACCESS
    FROM
    ".$InsPrefix."EMPLOYEE_POSITION;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_POSITION", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_DATA AS
    SELECT
    EMPLOYEE_DATA_ID AS EMP_DATA_ID,
    EMPLOYEE_DATA_SALARY AS EMP_DATA_SALARY,
    EMPLOYEE_DATA_NAME AS EMP_DATA_NAME,
    EMPLOYEE_DATA_SURNAME AS EMP_DATA_SURNAME,
    EMPLOYEE_DATA_EMAIL AS EMP_DATA_EMAIL,
    EMPLOYEE_DATA_PASSWORD AS EMP_DATA_PASS,
    EMPLOYEE_DATA_BDAY AS EMP_DATA_BDAY,
    EMPLOYEE_DATA_PN AS EMP_DATA_PN,
    EMPLOYEE_DATA_SN AS EMP_DATA_SN,
    AVAILABLE_ID AS EMP_DATA_AVAIL,
    ACCESS_LEVEL_ID AS EMP_DATA_ACCESS
    FROM
    ".$InsPrefix."EMPLOYEE_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW COUNTRY TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY AS
    SELECT
    COUNTRY_ID AS COUN_ID,
    COUNTRY_DATA_ID AS COUN_DATA_ID,
    AVAILABLE_ID AS COUN_AVAIL,
    ACCESS_LEVEL_ID AS COUN_ACCESS
    FROM
    ".$InsPrefix."COUNTRY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_DATA AS
    SELECT
    COUNTRY_DATA_ID AS COUN_DATA_ID,
    COUNTRY_DATA_Title AS COUN_DATA_TITLE,
    AVAILABLE_ID AS COUN_DATA_AVAIL,
    ACCESS_LEVEL_ID AS COUN_DATA_ACCESS
    FROM
    ".$InsPrefix."COUNTRY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW COUNTY TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY AS
    SELECT
    COUNTY_ID AS COU_ID,
    COUNTY_DATA_ID AS COU_DATA_ID,
    COUNTRY_ID AS COUN_ID,
    AVAILABLE_ID AS COU_AVAIL,
    ACCESS_LEVEL_ID AS COU_ACCESS
    FROM
    ".$InsPrefix."COUNTY;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_DATA AS
    SELECT
    COUNTY_DATA_ID AS COU_DATA_ID,
    COUNTY_DATA_TITLE AS COU_DATA_TITLE,
    COUNTY_DATA_TAX AS COU_DATA_TAX,
    COUNTY_DATA_INTEREST_RATE AS COU_DATA_IR,
    AVAILABLE_ID AS COU_DATA_AVAIL,
    ACCESS_LEVEL_ID AS COU_DATA_ACCESS
    FROM
    ".$InsPrefix."COUNTY_DATA;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW JOB TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_ASSIGMENT AS
    SELECT
    JOB_ASSIGMENT_ID AS JOB_ASS_ID,
    ACCESS_LEVEL_ID AS JOB_ASS_ACCESS,
    CUSTOMER_ID AS CUST_ID,
    EMPLOYEE_ID AS EMP_ID,
    JOB_ID AS JOB_ID,
    AVAILABLE_ID AS JOB_ASS_AVAIL,
    JOB_ASSIGMENT_CDate AS JOB_ASS_CDATE
    FROM
    ".$InsPrefix."JOB_ASSIGMENT;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_ASSIGMENT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB AS
    SELECT
    JOB_ID AS JOB_ID,
    JOB_DATA_ID AS JOB_DATA_ID,
    JOB_INCOME_ID AS JOB_INC_ID,
    JOB_OUTCOME_ID AS JOB_OUT_ID,
    COMPANY_ID AS COMP_ID,
    AVAILABLE_ID AS JOB_AVAIL,
    ACCESS_LEVEL_ID AS JOB_ACCESS
    FROM
    ".$InsPrefix."JOB;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_DATA AS
    SELECT
    JOB_DATA_ID AS JOB_DATA_ID,
    JOB_DATA_TITLE AS JOB_DATA_TITLE,
    JOB_DATA_DATE AS JOB_DATA_DATE,
    AVAILABLE_ID AS JOB_DATA_AVAIL,
    ACCESS_LEVEL_ID AS JOB_DATA_ACCESS
    FROM
    ".$InsPrefix."JOB_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_DATA", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME AS
    SELECT
    JOB_INCOME_ID AS JOB_INC_ID,
    JOB_INCOME_PRICE AS JOB_INC_PRICE,
    JOB_INCOME_PIA AS JOB_INC_PIA,
    AVAILABLE_ID AS JOB_INC_AVAIL,
    ACCESS_LEVEL_ID AS JOB_INC_ACCESS
    FROM
    ".$InsPrefix."JOB_INCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_OUTCOME AS
    SELECT
    JOB_OUTCOME_ID AS JOB_OUT_ID,
    JOB_OUTCOME_EXPENSES AS JOB_OUT_EXPENSES,
    JOB_OUTCOME_DAMAGE AS JOB_OUT_DAMAGE,
    AVAILABLE_ID AS JOB_OUT_AVAIL,
    ACCESS_LEVEL_ID AS JOB_OUT_ACCESS
    FROM
    ".$InsPrefix."JOB_OUTCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_OUTCOME", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_TIME AS
    SELECT
    JOB_INCOME_TIME_ID AS JOB_PIT_ID,
    JOB_INCOME_TIME_PIT AS JOB_PIT_PAYMENT,
    JOB_INCOME_TIME_DATE AS JOB_PIT_DATE,
    JOB_ID AS JOB_ID,
    AVAILABLE_ID AS JOB_PIT_AVAIL,
    ACCESS_LEVEL_ID AS JOB_PIT_ACCESS
    FROM
    ".$InsPrefix."JOB_INCOME_TIME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_TIME", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW CUSTOMER TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER AS
    SELECT
    CUSTOMER_ID AS CUST_ID,
    CUSTOMER_DATA_ID AS CUST_DATA_ID,
    AVAILABLE_ID AS CUST_AVAIL,
    ACCESS_LEVEL_ID AS CUST_ACCESS
    FROM
    ".$InsPrefix."CUSTOMER;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_DATA AS
    SELECT
    CUSTOMER_DATA_ID AS CUST_DATA_ID,
    CUSTOMER_DATA_NAME AS CUST_DATA_NAME,
    CUSTOMER_DATA_SURNAME AS CUST_DATA_SURNAME,
    CUSTOMER_DATA_PN AS CUST_DATA_PN,
    CUSTOMER_DATA_SN AS CUST_DATA_SN,
    CUSTOMER_DATA_EMAIL AS CUST_DATA_EMAIL,
    CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
    CUSTOMER_DATA_ADDR AS CUST_DATA_ADDR,
    CUSTOMER_DATA_NOTE AS CUST_DATA_NOTE,
    AVAILABLE_ID AS CUST_DATA_AVAIL,
    ACCESS_LEVEL_ID AS CUST_DATA_ACCESS
    FROM
    ".$InsPrefix."CUSTOMER_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW SHAREHOLDER TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_SHAREHOLDER AS
    SELECT
    SHAREHOLDER_ID AS SHARE_ID,
    EMPLOYEE_ID AS EMP_ID,
    AVAILABLE_ID AS SHARE_AVAIL,
    ACCESS_LEVEL_ID AS SHARE_ACCESS
    FROM
    ".$InsPrefix."SHAREHOLDER;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_SHAREHOLDER", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW COMPANY TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY AS
    SELECT
    COMPANY_ID AS COMP_ID,
    COMPANY_DATA_ID AS COMP_DATA_ID,
    COUNTY_ID AS COU_ID,
    AVAILABLE_ID AS COMP_AVAIL,
    ACCESS_LEVEL_ID AS COMP_ACCESS
    FROM
    ".$InsPrefix."COMPANY;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_DATA AS
    SELECT
    COMPANY_DATA_ID AS COMP_DATA_ID,
    COMPANY_DATA_TITLE AS COMP_DATA_TITLE,
    COMPANY_DATA_DATE AS COMP_DATA_DATE,
    AVAILABLE_ID AS COMP_DATA_AVAIL,
    ACCESS_LEVEL_ID AS COMP_DATA_ACCESS
    FROM
    ".$InsPrefix."COMPANY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_DATA", __FILE__, __FUNCTION__, __LINE__);


    /*--------<VIEW SPECIFIC TABLES>--------*/
    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_VISIBILITY AS
    SELECT
    COMPANY_ID AS COMP_ID,
    AVAILABLE_ID AS COMP_AVAIL_ID,
    ACCESS_LEVEL_ID AS COMP_ACCESS
    FROM
    ".$InsPrefix."COMPANY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_DATA_VISIBILITY AS
    SELECT
    COMPANY_DATA_ID AS COMP_DATA_ID,
    AVAILABLE_ID AS COMP_DATA_AVAIL_ID,
    ACCESS_LEVEL_ID AS COMP_DATA_ACCESS
    FROM
    ".$InsPrefix."COMPANY_DATA;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_DATA_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_VISIBILITY AS
    SELECT
    COUNTRY_ID AS COUN_ID,
    AVAILABLE_ID AS COUN_AVAIL_ID,
    ACCESS_LEVEL_ID AS COUN_ACCESS
    FROM
    ".$InsPrefix."COUNTRY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_DATA_VISIBILITY AS
    SELECT
    COUNTRY_DATA_ID AS COUN_DATA_ID,
    AVAILABLE_ID AS COUN_DATA_AVAIL_ID,
    ACCESS_LEVEL_ID AS COUN_DATA_ACCESS
    FROM
    ".$InsPrefix."COUNTRY_DATA;";
   
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_DATA_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_VISIBILITY AS
    SELECT
    COUNTY_ID AS COU_ID,
    AVAILABLE_ID AS COU_AVAIL_ID,
    ACCESS_LEVEL_ID AS COU_ACCESS
    FROM
    ".$InsPrefix."COUNTY;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_DATA_VISIBILITY AS
    SELECT
    COUNTY_DATA_ID AS COU_DATA_ID,
    AVAILABLE_ID AS COU_DATA_AVAIL_ID,
    ACCESS_LEVEL_ID AS COU_DATA_ACCESS
    FROM
    ".$InsPrefix."COUNTY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_DATA_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_VISIBILITY AS
    SELECT
    CUSTOMER_ID AS CUST_ID,
    AVAILABLE_ID AS CUST_AVAIL_ID,
    ACCESS_LEVEL_ID AS CUST_ACCESS
    FROM
    ".$InsPrefix."CUSTOMER;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_DATA_VISIBILITY AS
    SELECT
    CUSTOMER_DATA_ID AS CUST_DATA_ID,
    AVAILABLE_ID AS CUST_DATA_AVAIL_ID,
    ACCESS_LEVEL_ID AS CUST_DATA_ACCESS
    FROM
    ".$InsPrefix."CUSTOMER_DATA;";
    
    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_DATA_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_VISIBILITY AS
    SELECT
    EMPLOYEE_ID AS EMP_ID,
    AVAILABLE_ID AS EMP_AVAIL_ID,
    ACCESS_LEVEL_ID AS EMP_ACCESS
    FROM
    ".$InsPrefix."EMPLOYEE;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_DATA_VISIBILITY AS
    SELECT
    EMPLOYEE_DATA_ID AS EMP_DATA_ID,
    AVAILABLE_ID AS EMP_DATA_AVAIL_ID,
    ACCESS_LEVEL_ID AS EMP_DATA_ACCESS
    FROM
    ".$InsPrefix."EMPLOYEE_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_DATA_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_POSITION_VISIBILITY AS
    SELECT
    EMPLOYEE_POSITION_ID AS EMP_POS_ID,
    AVAILABLE_ID AS EMP_POS_AVAIL_ID,
    ACCESS_LEVEL_ID AS EMP_POS_ACCESS
    FROM
    ".$InsPrefix."EMPLOYEE_POSITION;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_POSITION_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_VISIBILITY AS
    SELECT
    JOB_ID AS JOB_ID,
    AVAILABLE_ID AS JOB_AVAIL_ID,
    ACCESS_LEVEL_ID AS JOB_ACCESS
    FROM
    ".$InsPrefix."JOB;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_DATA_VISIBILITY AS
    SELECT
    JOB_DATA_ID AS JOB_DATA_ID,
    AVAILABLE_ID AS JOB_DATA_AVAIL_ID,
    ACCESS_LEVEL_ID AS JOB_DATA_ACCESS
    FROM
    ".$InsPrefix."JOB_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_DATA_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_VISIBILITY AS
    SELECT
    JOB_INCOME_ID AS JOB_INC_ID,
    AVAILABLE_ID AS JOB_INC_AVAIL_ID,
    ACCESS_LEVEL_ID AS JOB_INC_ACCESS
    FROM
    ".$InsPrefix."JOB_INCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_OUTCOME_VISIBILITY AS
    SELECT
    JOB_OUTCOME_ID AS JOB_OUT_ID,
    AVAILABLE_ID AS JOB_OUT_AVAIL_ID,
    ACCESS_LEVEL_ID AS JOB_OUT_ACCESS
    FROM
    ".$InsPrefix."JOB_OUTCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_OUTCOME_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY AS
    SELECT
    JOB_INCOME_TIME_ID AS JOB_PIT_ID,
    AVAILABLE_ID AS JOB_PIT_AVAIL_ID,
    ACCESS_LEVEL_ID AS JOB_PIT_ACCESS
    FROM
    ".$InsPrefix."JOB_INCOME_TIME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_TIME_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_SHAREHOLDER_VISIBILITY AS
    SELECT
    SHAREHOLDER_ID AS SHARE_ID,
    AVAILABLE_ID AS SHARE_AVAIL_ID,
    ACCESS_LEVEL_ID AS SHARE_ACCESS
    FROM
    ".$InsPrefix."SHAREHOLDER;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_SHAREHOLDER_VISIBILITY", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_ADD AS
    SELECT
    COMPANY_DATA_ID AS COMP_DATA_ID,
    COUNTY_ID AS COU_ID,
    ACCESS_LEVEL_ID AS COMP_ACCESS_ID,
    AVAILABLE_ID AS COMP_AVAIL_ID
    FROM
    ".$InsPrefix."COMPANY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_DATA_ADD AS
    SELECT
    COMPANY_DATA_TITLE AS COMP_DATA_TITLE,
    COMPANY_DATA_DATE AS COMP_DATA_DATE,
    ACCESS_LEVEL_ID AS COMP_DATA_ACCESS_ID,
    AVAILABLE_ID AS COMP_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."COMPANY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_DATA_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_ADD AS
    SELECT
    COUNTRY_DATA_ID AS COUN_DATA_ID,
    ACCESS_LEVEL_ID AS COUN_ACCESS_ID,
    AVAILABLE_ID AS COUN_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTRY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_DATA_ADD AS
    SELECT
    COUNTRY_DATA_TITLE AS COUN_DATA_TITLE,
    ACCESS_LEVEL_ID AS COUN_DATA_ACCESS_ID,
    AVAILABLE_ID AS COUN_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTRY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_DATA_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_ADD AS
    SELECT
    COUNTY_DATA_ID AS COU_DATA_ID,
    COUNTRY_ID AS COUN_ID,
    ACCESS_LEVEL_ID AS COU_ACCESS_ID,
    AVAILABLE_ID AS COU_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_DATA_ADD AS
    SELECT
    COUNTY_DATA_TITLE AS COU_DATA_TITLE,
    COUNTY_DATA_TAX AS COU_DATA_TAX,
    COUNTY_DATA_INTEREST_RATE AS COU_DATA_IR,
    ACCESS_LEVEL_ID AS COU_DATA_ACCESS_ID,
    AVAILABLE_ID AS COU_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_DATA_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_ADD AS
    SELECT
    CUSTOMER_DATA_ID AS CUST_DATA_ID,
    ACCESS_LEVEL_ID AS CUST_ACCESS_ID,
    AVAILABLE_ID AS CUST_AVAIL_ID
    FROM
    ".$InsPrefix."CUSTOMER;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_DATA_ADD AS
    SELECT
    CUSTOMER_DATA_NAME AS CUST_DATA_NAME,
    CUSTOMER_DATA_SURNAME AS CUST_DATA_SURNAME,
    CUSTOMER_DATA_PN AS CUST_DATA_PN,
    CUSTOMER_DATA_SN AS CUST_DATA_SN,
    CUSTOMER_DATA_EMAIL AS CUST_DATA_EMAIL,
    CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
    CUSTOMER_DATA_ADDR AS CUST_DATA_ADDR,
    CUSTOMER_DATA_NOTE AS CUST_DATA_NOTE,
    ACCESS_LEVEL_ID AS CUST_DATA_ACCESS_ID,
    AVAILABLE_ID AS CUST_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."CUSTOMER_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_DATA_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_ADD AS
    SELECT
    EMPLOYEE_DATA_ID AS EMP_DATA_ID,
    EMPLOYEE_POSITION_ID AS EMP_POS_ID,
    COMPANY_ID AS COMP_ID,
    ACCESS_LEVEL_ID AS EMP_ACCESS_ID,
    AVAILABLE_ID AS EMP_AVAIL_ID
    FROM
    ".$InsPrefix."EMPLOYEE;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_DATA_ADD AS
    SELECT
    EMPLOYEE_DATA_SALARY AS EMP_DATA_SALARY,
    EMPLOYEE_DATA_BDAY AS EMP_DATA_BDAY,
    EMPLOYEE_DATA_PASSWORD AS EMP_DATA_PASS,
    EMPLOYEE_DATA_PN AS EMP_DATA_PN,
    EMPLOYEE_DATA_SN AS EMP_DATA_SN,
    EMPLOYEE_DATA_EMAIL AS EMP_DATA_EMAIL,
    EMPLOYEE_DATA_NAME AS EMP_DATA_NAME,
    EMPLOYEE_DATA_SURNAME AS EMP_DATA_SURNAME,
    ACCESS_LEVEL_ID AS EMP_DATA_ACCESS_ID,
    AVAILABLE_ID AS EMP_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."EMPLOYEE_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_DATA_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_POSITION_ADD AS
    SELECT
    EMPLOYEE_POSITION_TITLE AS EMP_POS_TITLE,
    ACCESS_LEVEL_ID AS EMP_POS_ACCESS_ID,
    AVAILABLE_ID AS EMP_POS_AVAIL_ID
    FROM
    ".$InsPrefix."EMPLOYEE_POSITION;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_POSITION_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_ADD AS
    SELECT
    JOB_DATA_ID AS JOB_DATA_ID,
    JOB_INCOME_ID AS JOB_INC_ID,
    JOB_OUTCOME_ID AS JOB_OUT_ID,
    COMPANY_ID AS COMP_ID,
    ACCESS_LEVEL_ID AS JOB_ACCESS_ID,
    AVAILABLE_ID AS JOB_AVAIL_ID
    FROM
    ".$InsPrefix."JOB;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_DATA_ADD AS
    SELECT
    JOB_DATA_TITLE AS JOB_DATA_TITLE,
    JOB_DATA_DATE AS JOB_DATA_DATE,
    ACCESS_LEVEL_ID AS JOB_DATA_ACCESS_ID,
    AVAILABLE_ID AS JOB_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_DATA_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_ADD AS
    SELECT
    JOB_INCOME_PRICE AS JOB_INC_PRICE,
    JOB_INCOME_PIA AS JOB_INC_PIA,
    ACCESS_LEVEL_ID AS JOB_INC_ACCESS_ID,
    AVAILABLE_ID AS JOB_INC_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_INCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_OUTCOME_ADD AS
    SELECT
    JOB_OUTCOME_EXPENSES AS JOB_OUT_EXPENSES,
    JOB_OUTCOME_DAMAGE AS JOB_OUT_DAMAGE,
    ACCESS_LEVEL_ID AS JOB_OUT_ACCESS_ID,
    AVAILABLE_ID AS JOB_OUT_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_OUTCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_OUTCOME_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_TIME_ADD AS
    SELECT
    JOB_ID AS JOB_ID,
    JOB_INCOME_TIME_PIT AS JOB_PIT_PAYMENT,
    JOB_INCOME_TIME_DATE AS JOB_PIT_DATE,
    ACCESS_LEVEL_ID AS JOB_PIT_ACCESS_ID,
    AVAILABLE_ID AS JOB_PIT_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_INCOME_TIME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_TIME_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_SHAREHOLDER_ADD AS
    SELECT
    EMPLOYEE_ID AS EMP_ID,
    ACCESS_LEVEL_ID AS SHARE_ACCESS_ID,
    AVAILABLE_ID AS SHARE_AVAIL_ID
    FROM
    ".$InsPrefix."SHAREHOLDER;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_SHAREHOLDER_ADD", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_EDIT AS
    SELECT
    COMPANY_ID AS COMP_ID,
    COUNTY_ID AS COU_ID,
    ACCESS_LEVEL_ID AS COMP_ACCESS_ID,
    AVAILABLE_ID AS COMP_AVAIL_ID
    FROM
    ".$InsPrefix."COMPANY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_DATA_EDIT AS
    SELECT
    COMPANY_DATA_ID AS COMP_DATA_ID,
    COMPANY_DATA_TITLE AS COMP_DATA_TITLE,
    COMPANY_DATA_DATE AS COMP_DATA_DATE,
    ACCESS_LEVEL_ID AS COMP_DATA_ACCESS_ID,
    AVAILABLE_ID AS COMP_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."COMPANY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_DATA_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_EDIT AS
    SELECT
    COUNTRY_ID AS COUN_ID,
    ACCESS_LEVEL_ID AS COUN_ACCESS_ID,
    AVAILABLE_ID AS COUN_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTRY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_DATA_EDIT AS
    SELECT
    COUNTRY_DATA_ID AS COUN_DATA_ID,
    COUNTRY_DATA_TITLE AS COUN_DATA_TITLE,
    ACCESS_LEVEL_ID AS COUN_DATA_ACCESS_ID,
    AVAILABLE_ID AS COUN_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTRY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_DATA_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_EDIT AS
    SELECT
    COUNTY_ID AS COU_ID,
    COUNTRY_ID AS COUN_ID,
    ACCESS_LEVEL_ID AS COU_ACCESS_ID,
    AVAILABLE_ID AS COU_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTY;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_DATA_EDIT AS
    SELECT
    COUNTY_DATA_ID AS COU_DATA_ID,
    COUNTY_DATA_TITLE AS COU_DATA_TITLE,
    COUNTY_DATA_TAX AS COU_DATA_TAX,
    COUNTY_DATA_INTEREST_RATE AS COU_DATA_IR,
    ACCESS_LEVEL_ID AS COU_DATA_ACCESS_ID,
    AVAILABLE_ID AS COU_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."COUNTY_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_DATA_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_EDIT AS
    SELECT
    CUSTOMER_ID AS CUST_ID,
    ACCESS_LEVEL_ID AS CUST_ACCESS_ID,
    AVAILABLE_ID AS CUST_AVAIL_ID
    FROM
    ".$InsPrefix."CUSTOMER;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_DATA_EDIT AS
    SELECT
    CUSTOMER_DATA_ID AS CUST_DATA_ID,
    CUSTOMER_DATA_NAME AS CUST_DATA_NAME,
    CUSTOMER_DATA_SURNAME AS CUST_DATA_SURNAME,
    CUSTOMER_DATA_PN AS CUST_DATA_PN,
    CUSTOMER_DATA_SN AS CUST_DATA_SN,
    CUSTOMER_DATA_EMAIL AS CUST_DATA_EMAIL,
    CUSTOMER_DATA_VAT AS CUST_DATA_VAT,
    CUSTOMER_DATA_ADDR AS CUST_DATA_ADDR,
    CUSTOMER_DATA_NOTE AS CUST_DATA_NOTE,
    ACCESS_LEVEL_ID AS CUST_DATA_ACCESS_ID,
    AVAILABLE_ID AS CUST_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."CUSTOMER_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_DATA_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_EDIT AS
    SELECT
    EMPLOYEE_ID AS EMP_ID,
    EMPLOYEE_POSITION_ID AS EMP_POS_ID,
    COMPANY_ID AS COMP_ID,
    ACCESS_LEVEL_ID AS EMP_ACCESS_ID,
    AVAILABLE_ID AS EMP_AVAIL_ID
    FROM
    ".$InsPrefix."EMPLOYEE;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_DATA_EDIT AS
    SELECT
    EMPLOYEE_DATA_ID AS EMP_DATA_ID,
    EMPLOYEE_DATA_SALARY AS EMP_DATA_SALARY,
    EMPLOYEE_DATA_BDAY AS EMP_DATA_BDAY,
    EMPLOYEE_DATA_PN AS EMP_DATA_PN,
    EMPLOYEE_DATA_SN AS EMP_DATA_SN,
    EMPLOYEE_DATA_EMAIL AS EMP_DATA_EMAIL,
    EMPLOYEE_DATA_NAME AS EMP_DATA_NAME,
    EMPLOYEE_DATA_SURNAME AS EMP_DATA_SURNAME,
    ACCESS_LEVEL_ID AS EMP_DATA_ACCESS_ID,
    AVAILABLE_ID AS EMP_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."EMPLOYEE_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_DATA_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_POSITION_EDIT AS
    SELECT
    EMPLOYEE_POSITION_ID AS EMP_POS_ID,
    EMPLOYEE_POSITION_TITLE AS EMP_POS_TITLE,
    ACCESS_LEVEL_ID AS EMP_POS_ACCESS_ID,
    AVAILABLE_ID AS EMP_POS_AVAIL_ID
    FROM
    ".$InsPrefix."EMPLOYEE_POSITION;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_POSITION_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_EDIT AS
    SELECT
    JOB_ID AS JOB_ID,
    JOB_DATA_ID AS JOB_DATA_ID,
    COMPANY_ID AS COMP_ID,
    ACCESS_LEVEL_ID AS JOB_ACCESS_ID,
    AVAILABLE_ID AS JOB_AVAIL_ID
    FROM
    ".$InsPrefix."JOB;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_DATA_EDIT AS
    SELECT
    JOB_DATA_ID AS JOB_DATA_ID,
    JOB_DATA_TITLE AS JOB_DATA_TITLE,
    JOB_DATA_DATE AS JOB_DATA_DATE,
    ACCESS_LEVEL_ID AS JOB_DATA_ACCESS_ID,
    AVAILABLE_ID AS JOB_DATA_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_DATA;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_DATA_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_EDIT AS
    SELECT
    JOB_INCOME_ID AS JOB_INC_ID,
    JOB_INCOME_PRICE AS JOB_INC_PRICE,
    JOB_INCOME_PIA AS JOB_INC_PIA,
    ACCESS_LEVEL_ID AS JOB_INC_ACCESS_ID,
    AVAILABLE_ID AS JOB_INC_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_INCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_OUTCOME_EDIT AS
    SELECT
    JOB_OUTCOME_ID AS JOB_OUT_ID,
    JOB_OUTCOME_EXPENSES AS JOB_OUT_EXPENSES,
    JOB_OUTCOME_DAMAGE AS JOB_OUT_DAMAGE,
    ACCESS_LEVEL_ID AS JOB_OUT_ACCESS_ID,
    AVAILABLE_ID AS JOB_OUT_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_OUTCOME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_OUTCOME_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_TIME_EDIT AS
    SELECT
    JOB_INCOME_TIME_ID AS JOB_PIT_ID,
    JOB_INCOME_TIME_PIT AS JOB_PIT_PAYMENT,
    JOB_INCOME_TIME_DATE AS JOB_PIT_DATE,
    ACCESS_LEVEL_ID AS JOB_PIT_ACCESS_ID,
    AVAILABLE_ID AS JOB_PIT_AVAIL_ID
    FROM
    ".$InsPrefix."JOB_INCOME_TIME;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_TIME_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_SHAREHOLDER_EDIT AS
    SELECT
    SHAREHOLDER_ID AS SHARE_ID,
    EMPLOYEE_ID AS EMP_ID,
    ACCESS_LEVEL_ID AS SHARE_ACCESS_ID,
    AVAILABLE_ID AS SHARE_AVAIL_ID
    FROM
    ".$InsPrefix."SHAREHOLDER;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_SHAREHOLDER_EDIT", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_LOGIN AS
    SELECT
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_ID,
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PASS,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS
    FROM
    ".$InsPrefix."VIEW_EMPLOYEE,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA
    WHERE
    (".$InsPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_LOGIN", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COMPANY_OVERVIEW AS
    SELECT 
    ".$InsPrefix."COMPANY.COMPANY_ID AS COMP_ID,
    ".$InsPrefix."COMPANY.ACCESS_LEVEL_ID AS COMP_ACCESS,
    ".$InsPrefix."COMPANY.AVAILABLE_ID AS COMP_AVAIL,
    ".$InsPrefix."COMPANY_DATA.ACCESS_LEVEL_ID AS COMP_DATA_ACCESS,
    ".$InsPrefix."COMPANY_DATA.AVAILABLE_ID AS COMP_DATA_AVAIL,
    ".$InsPrefix."COMPANY_DATA.COMPANY_DATA_TITLE AS COMP_DATA_TITLE,
    ".$InsPrefix."COMPANY_DATA.COMPANY_DATA_DATE AS COMP_DATA_DATE,
    ".$InsPrefix."COUNTY.ACCESS_LEVEL_ID AS COU_ACCESS,
    ".$InsPrefix."COUNTY.AVAILABLE_ID AS COU_AVAIL,
    ".$InsPrefix."COUNTY_DATA.COUNTY_DATA_TITLE AS COU_DATA_TITLE,
    ".$InsPrefix."COUNTY_DATA.COUNTY_DATA_TAX AS COU_DATA_TAX,
    ".$InsPrefix."COUNTY_DATA.COUNTY_DATA_INTEREST_RATE AS COU_DATA_IR,
    ".$InsPrefix."COUNTY_DATA.ACCESS_LEVEL_ID AS COU_DATA_ACCESS,
    ".$InsPrefix."COUNTY_DATA.AVAILABLE_ID AS COU_DATA_AVAIL,
    ".$InsPrefix."COUNTRY.ACCESS_LEVEL_ID AS COUN_ACCESS,
    ".$InsPrefix."COUNTRY.AVAILABLE_ID AS COUN_AVAIL,
    ".$InsPrefix."COUNTRY_DATA.COUNTRY_DATA_TITLE AS COUN_DATA_TITLE,
    ".$InsPrefix."COUNTRY_DATA.ACCESS_LEVEL_ID AS COUN_DATA_ACCESS,
    ".$InsPrefix."COUNTRY_DATA.AVAILABLE_ID AS COUN_DATA_AVAIL
    FROM 
    ".$InsPrefix."COMPANY,
    ".$InsPrefix."COMPANY_DATA,
    ".$InsPrefix."COUNTY,
    ".$InsPrefix."COUNTY_DATA,
    ".$InsPrefix."COUNTRY,
    ".$InsPrefix."COUNTRY_DATA
    WHERE 
    ".$InsPrefix."COMPANY.COMPANY_DATA_ID = ".$InsPrefix."COMPANY_DATA.COMPANY_DATA_ID
    AND
    ".$InsPrefix."COMPANY.COUNTY_ID = ".$InsPrefix."COUNTY.COUNTY_ID
    AND
    ".$InsPrefix."COUNTY.COUNTY_DATA_ID = ".$InsPrefix."COUNTY_DATA.COUNTY_DATA_ID
    AND
    ".$InsPrefix."COUNTRY.COUNTRY_ID = ".$InsPrefix."COUNTY.COUNTRY_ID
    AND
    ".$InsPrefix."COUNTRY.COUNTRY_DATA_ID = ".$InsPrefix."COUNTRY_DATA.COUNTRY_DATA_ID;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COMPANY_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTRY_OVERVIEW AS
    SELECT
    ".$InsPrefix."VIEW_COUNTRY.COUN_ID,
    ".$InsPrefix."VIEW_COUNTRY.COUN_ACCESS,
    ".$InsPrefix."VIEW_COUNTRY.COUN_AVAIL,
    ".$InsPrefix."VIEW_COUNTRY_DATA.COUN_DATA_TITLE,
    ".$InsPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ACCESS,
    ".$InsPrefix."VIEW_COUNTRY_DATA.COUN_DATA_AVAIL
    FROM
    ".$InsPrefix."VIEW_COUNTRY,
    ".$InsPrefix."VIEW_COUNTRY_DATA
    WHERE
    (".$InsPrefix."VIEW_COUNTRY.COUN_DATA_ID = ".$InsPrefix."VIEW_COUNTRY_DATA.COUN_DATA_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTRY_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_OVERVIEW AS
    SELECT
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_ID,
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_ACCESS,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_PN,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SN,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS
    FROM
    ".$InsPrefix."VIEW_EMPLOYEE,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION
    WHERE
    (".$InsPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID
    AND
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_POS_ID = ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_EMPLOYEE_POSITION_OVERVIEW AS
    SELECT
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS
    FROM
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_EMPLOYEE_POSITION_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_OVERVIEW AS
    SELECT 
    ".$InsPrefix."VIEW_JOB.JOB_ID, 
    ".$InsPrefix."VIEW_JOB.JOB_AVAIL,
    ".$InsPrefix."VIEW_JOB.JOB_ACCESS, 
    ".$InsPrefix."VIEW_JOB_DATA.JOB_DATA_TITLE, 
    ".$InsPrefix."VIEW_JOB_DATA.JOB_DATA_DATE, 
    ".$InsPrefix."VIEW_JOB_DATA.JOB_DATA_AVAIL, 
    ".$InsPrefix."VIEW_JOB_DATA.JOB_DATA_ACCESS, 
    ".$InsPrefix."VIEW_JOB_INCOME.JOB_INC_PRICE, 
    ".$InsPrefix."VIEW_JOB_INCOME.JOB_INC_PIA, 
    ".$InsPrefix."VIEW_JOB_INCOME.JOB_INC_AVAIL, 
    ".$InsPrefix."VIEW_JOB_INCOME.JOB_INC_ACCESS, 
    ".$InsPrefix."VIEW_JOB_OUTCOME.JOB_OUT_EXPENSES, 
    ".$InsPrefix."VIEW_JOB_OUTCOME.JOB_OUT_DAMAGE, 
    ".$InsPrefix."VIEW_JOB_OUTCOME.JOB_OUT_AVAIL, 
    ".$InsPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ACCESS, 
    ".$InsPrefix."VIEW_COMPANY_DATA.COMP_DATA_TITLE,
    ".$InsPrefix."VIEW_COMPANY_DATA.COMP_DATA_ACCESS, 
    ".$InsPrefix."VIEW_COMPANY_DATA.COMP_DATA_AVAIL 
    FROM 
    ".$InsPrefix."VIEW_JOB, 
    ".$InsPrefix."VIEW_JOB_DATA, 
    ".$InsPrefix."VIEW_JOB_INCOME, 
    ".$InsPrefix."VIEW_JOB_OUTCOME,
    ".$InsPrefix."VIEW_COMPANY, 
    ".$InsPrefix."VIEW_COMPANY_DATA 
    WHERE 
    (".$InsPrefix."VIEW_JOB.JOB_DATA_ID = ".$InsPrefix."VIEW_JOB_DATA.JOB_DATA_ID 
    AND 
    ".$InsPrefix."VIEW_JOB.JOB_INC_ID = ".$InsPrefix."VIEW_JOB_INCOME.JOB_INC_ID
    AND 
    ".$InsPrefix."VIEW_JOB.JOB_OUT_ID = ".$InsPrefix."VIEW_JOB_OUTCOME.JOB_OUT_ID
    AND
    ".$InsPrefix."VIEW_JOB.COMP_ID = ".$InsPrefix."VIEW_COMPANY.COMP_ID 
    AND
    ".$InsPrefix."VIEW_COMPANY.COMP_DATA_ID = ".$InsPrefix."VIEW_COMPANY_DATA.COMP_DATA_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_JOB_INCOME_TIME_SUM AS
    SELECT
    ".$InsPrefix."VIEW_JOB.JOB_ID,
    SUM(".$InsPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_PAYMENT) AS JOB_PIT_SUM,
    ".$InsPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL,
    ".$InsPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS
    FROM
    ".$InsPrefix."VIEW_JOB,
    ".$InsPrefix."VIEW_JOB_INCOME_TIME
    WHERE
    (".$InsPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = ".$GLOBALS['AVAILABLE']['SHOW'].")
    AND
    (".$InsPrefix."VIEW_JOB_INCOME_TIME.JOB_ID = ".$InsPrefix."VIEW_JOB.JOB_ID)
    GROUP BY
    (".$InsPrefix."VIEW_JOB.JOB_ID)
    ORDER BY
    ".$InsPrefix."VIEW_JOB.JOB_ID ASC;";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_JOB_INCOME_TIME_SUM", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_SHAREHOLDER_OVERVIEW AS
    SELECT
    ".$InsPrefix."VIEW_SHAREHOLDER.SHARE_ID,
    ".$InsPrefix."VIEW_SHAREHOLDER.SHARE_AVAIL,
    ".$InsPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ACCESS,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SALARY,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_NAME,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_SURNAME,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_EMAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_BDAY,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_TITLE,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS
    FROM
    ".$InsPrefix."VIEW_SHAREHOLDER,
    ".$InsPrefix."VIEW_EMPLOYEE,
    ".$InsPrefix."VIEW_EMPLOYEE_DATA,
    ".$InsPrefix."VIEW_EMPLOYEE_POSITION
    WHERE
    (".$InsPrefix."VIEW_SHAREHOLDER.EMP_ID = ".$InsPrefix."VIEW_EMPLOYEE.EMP_ID
    AND
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_DATA_ID = ".$InsPrefix."VIEW_EMPLOYEE_DATA.EMP_DATA_ID
    AND
    ".$InsPrefix."VIEW_EMPLOYEE.EMP_POS_ID = ".$InsPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_SHAREHOLDER_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_CUSTOMER_OVERVIEW AS
    SELECT
    ".$InsPrefix."VIEW_CUSTOMER.CUST_ID,
    ".$InsPrefix."VIEW_CUSTOMER.CUST_AVAIL,
    ".$InsPrefix."VIEW_CUSTOMER.CUST_ACCESS,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NAME,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SURNAME,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_PN,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_SN,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_EMAIL,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_VAT,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ADDR,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_NOTE,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_AVAIL,
    ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ACCESS
    FROM
    ".$InsPrefix."VIEW_CUSTOMER,
    ".$InsPrefix."VIEW_CUSTOMER_DATA
    WHERE
    (".$InsPrefix."VIEW_CUSTOMER.CUST_DATA_ID = ".$InsPrefix."VIEW_CUSTOMER_DATA.CUST_DATA_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_CUSTOMER_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);


    $sQuery="CREATE ALGORITHM = MERGE VIEW ".$InsPrefix."VIEW_COUNTY_OVERVIEW AS
    SELECT
    ".$InsPrefix."VIEW_COUNTY.COU_ID,
    ".$InsPrefix."VIEW_COUNTY.COU_AVAIL,
    ".$InsPrefix."VIEW_COUNTY.COU_ACCESS,
    ".$InsPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
    ".$InsPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
    ".$InsPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
    ".$InsPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL,
    ".$InsPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS
    FROM
    ".$InsPrefix."VIEW_COUNTY,
    ".$InsPrefix."VIEW_COUNTY_DATA
    WHERE
    (".$InsPrefix."VIEW_COUNTY.COU_DATA_ID = ".$InsPrefix."VIEW_COUNTY_DATA.COU_DATA_ID);";

    if(!StatementQueryCheck($rStatement, $sQuery, $InrInstallationErrorLog))
        $InrInstallationErrorLog->AddLogMessage("Failed to create View Table VIEW_COUNTY_OVERVIEW", __FILE__, __FUNCTION__, __LINE__);

    $rStatement->close();
}
?>