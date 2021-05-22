<?php
function InsertDemoData(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrInstallationErrorLog, string &$InsPrefix)
{
    /*--------<INSERT DATA TO TABLE COUNTRY_DATA>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."COUNTRY_DATA
    (COUNTRY_DATA_TITLE,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?, ?, ?);";

    $rStatement = $InrConn->CreateStatement($sQuery);

    $sCountryDataTitle = "Greece";

    $rStatement->bind_param("sii", $sCountryDataTitle, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE COUNTRY>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."COUNTRY
    (COUNTRY_DATA_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?, ?, ?);";

    $rStatement->prepare($sQuery);

    $iCountryDataID = 1;

    $rStatement->bind_param("iii", $iCountryDataID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE COUNTY_DATA>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."COUNTY_DATA
    (COUNTY_DATA_TITLE,
    COUNTY_DATA_TAX,
    COUNTY_DATA_INTEREST_RATE,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?, ?, ?, ?, ?);";

    $rStatement->prepare($sQuery);

    $sCountyDataTitle = "Chios";
    $iCountyDataTax = 7;
    $iCountyDataIR = 2;

    $rStatement->bind_param("siiii", $sCountyDataTitle, $iCountyDataTax, $iCountyDataIR, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE COUNTY>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."COUNTY
    (COUNTRY_ID,
    COUNTY_DATA_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?, ?, ?, ?);";

    $rStatement->prepare($sQuery);

    $iCountryID = 1;
    $iCountyDataID = 1;

    $rStatement->bind_param("iiii", $iCountryID, $iCountyDataID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE COMPANY_DATA>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."COMPANY_DATA
    (COMPANY_DATA_TITLE,
    COMPANY_DATA_DATE,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?);";

    $rStatement->prepare($sQuery);

    $sCompanyDataTitle = "Demo Studio";
    $sCompanyDataDate = "1995-1-1";

    $rStatement->bind_param("ssii", $sCompanyDataTitle, $sCompanyDataDate, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE COMPANY>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."COMPANY
    (COMPANY_DATA_ID,
    COUNTY_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?);";

    $rStatement->prepare($sQuery);

    $iCompanyDataID = 1;
    $iCountyID = 1;

    $rStatement->bind_param("iiii", $iCompanyDataID, $iCountyID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();


    /*--------<INSERT DATA TO TABLE EMPLOYEE_POSITION>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."EMPLOYEE_POSITION
    (EMPLOYEE_POSITION_TITLE,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?);";

    $rStatement->prepare($sQuery);

    $sEmployeePositionTitle = "CEO";

    $rStatement->bind_param("sii", $sEmployeePositionTitle, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "COO";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "CFO";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "CIO";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "CBO";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "CMO";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Video Editor";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Server Admin";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Game Developer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Producer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Manager";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Developer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Game Designer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Artist";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "3D Artist";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Game Level Designer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Marketeer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Human Resource";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Programmer";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sEmployeePositionTitle = "Software Enginner";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE EMPLOYEE_DATA>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."EMPLOYEE_DATA
    (EMPLOYEE_DATA_SALARY,
    EMPLOYEE_DATA_BDAY,
    EMPLOYEE_DATA_NAME,
    EMPLOYEE_DATA_SURNAME,
    EMPLOYEE_DATA_PN,
    EMPLOYEE_DATA_EMAIL,
    EMPLOYEE_DATA_PASSWORD,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?,?,?,?,?,?);";

    $rStatement->prepare($sQuery);

    $fEmployeeDataSalary = 0;
    $sEmployeeDataBDay = "1970-1-1";
    $sEmployeeDataName = "Server";
    $sEmployeeDataSurname = "Admin";
    $sEmployeeDataPN = "6767676767";
    $sEmployeeDataEmail = "Adm@email.com";
    $sEmployeeDataPassword = password_hash("AdminPass", PASSWORD_BCRYPT, ["cost" => 10]);
    $iAccessLevelID = $GLOBALS['ACCESS']['ADMIN'];
    $iAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->bind_param("dssssssii", $fEmployeeDataSalary, $sEmployeeDataBDay, $sEmployeeDataName, $sEmployeeDataSurname, $sEmployeeDataPN, $sEmployeeDataEmail, $sEmployeeDataPassword, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fEmployeeDataSalary = 0;
    $sEmployeeDataBDay = "1970-1-1";
    $sEmployeeDataName = "Μενελαος";
    $sEmployeeDataSurname = "Μπρουνζης";
    $sEmployeeDataPN = "6868686868";
    $sEmployeeDataEmail = "Men@email.com";
    $sEmployeeDataPassword = password_hash("MenPass", PASSWORD_BCRYPT, ["cost" => 10]);
    $iAccessLevelID = $GLOBALS['ACCESS']['CEO'];
    $iAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $fEmployeeDataSalary = 0;
    $sEmployeeDataBDay = "1970-1-1";
    $sEmployeeDataName = "Μιχαηλ";
    $sEmployeeDataSurname = "Καλογιανης";
    $sEmployeeDataPN = "6969696969";
    $sEmployeeDataEmail = "Mix@email.com";
    $sEmployeeDataPassword = password_hash("MixPass", PASSWORD_BCRYPT, ["cost" => 10]);
    $iAccessLevelID = $GLOBALS['ACCESS']['EMPLOYEE'];
    $iAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fEmployeeDataSalary = 0;
    $sEmployeeDataBDay = "1970-1-1";
    $sEmployeeDataName = "Καληγουλα";
    $sEmployeeDataSurname = "Κακογιανης";
    $sEmployeeDataPN = "7070707070";
    $sEmployeeDataEmail = "Kal@email.com";
    $sEmployeeDataPassword = password_hash("KalPass", PASSWORD_BCRYPT, ["cost" => 10]);
    $iAccessLevelID = $GLOBALS['ACCESS']['EMPLOYEE'];
    $iAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE EMPLOYEE>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."EMPLOYEE
    (EMPLOYEE_POSITION_ID,
    EMPLOYEE_DATA_ID,
    COMPANY_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?,?);";

    $rStatement->prepare($sQuery);

    $iEmployeePositionID = 8;
    $iEmployeeDataID = 1;
    $iCompanyID = 1;
    $iAccessLevelID = $GLOBALS['ACCESS']['ADMIN'];
    $iAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->bind_param("iiiii", $iEmployeePositionID, $iEmployeeDataID, $iCompanyID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iEmployeePositionID = 7;
    $iEmployeeDataID = 2;
    $iCompanyID = 1;
    $iAccessLevelID = $GLOBALS['ACCESS']['CEO'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iEmployeePositionID = 1;
    $iEmployeeDataID = 3;
    $iCompanyID = 1;
    $iAccessLevelID = $GLOBALS['ACCESS']['EMPLOYEE'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iEmployeePositionID = 20;
    $iEmployeeDataID = 4;
    $iCompanyID = 1;
    $iAccessLevelID = $GLOBALS['ACCESS']['EMPLOYEE'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE SHAREHOLDER>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."SHAREHOLDER
    (EMPLOYEE_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?);";

    $rStatement->prepare($sQuery);

    $iEmployeeID = 2;
    $iAccessLevelID = $GLOBALS['ACCESS']['CEO'];

    $rStatement->bind_param("iii", $iEmployeeID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iEmployeeID = 1;
    $iAccessLevelID = $GLOBALS['ACCESS']['CEO'];

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    unset($iEmployeeID);


    /*--------<INSERT DATA TO TABLE CUSTOMER_DATA>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."CUSTOMER_DATA
    (CUSTOMER_DATA_NAME,
    CUSTOMER_DATA_SURNAME,
    CUSTOMER_DATA_VAT,
    CUSTOMER_DATA_PN,
    CUSTOMER_DATA_SN,
    CUSTOMER_DATA_EMAIL,
    CUSTOMER_DATA_ADDR,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?,?,?,?,?,?);";

    $rStatement->prepare($sQuery);

    $sCustomerDataName = "John";
    $sCustomerDataSurname = "Marchel";
    $sCustomerDataVAT = "000000000";
    $sCustomerDataPN = "6767676768";
    $sCustomerDataSN = "2271023333";
    $sCustomerDataEmail = "JohnM@Email.com";
    $sCustomerDataAddr = "ST. Luther Street 32";
    $iAccessLevelID = $GLOBALS['ACCESS']['CEO'];
    $iAvailableID = $GLOBALS['AVAILABLE']['SHOW'];

    $rStatement->bind_param("sssssssii", $sCustomerDataName, $sCustomerDataSurname, $sCustomerDataVAT, $sCustomerDataPN, $sCustomerDataSN, $sCustomerDataEmail, $sCustomerDataAddr, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sCustomerDataName = "Maria";
    $sCustomerDataSurname = "Minerva";
    $sCustomerDataVAT = "000000001";
    $sCustomerDataPN = "6767676767";
    $sCustomerDataSN = "2271023333";
    $sCustomerDataEmail = "MariaM@Email.com";
    $sCustomerDataAddr = "ST. Luther Street 33";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE CUSTOMER>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."CUSTOMER
    (CUSTOMER_DATA_ID,
    AVAILABLE_ID,
    ACCESS_LEVEL_ID)
    VALUES
    (?,?,?);";

    $rStatement->prepare($sQuery);

    $iCustomerDataID = 1;

    $rStatement->bind_param("iii", $iCustomerDataID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iCustomerDataID = 2;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE JOB_INCOME>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."JOB_INCOME
    (JOB_INCOME_PRICE,
    JOB_INCOME_PIA,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?);";

    $rStatement->prepare($sQuery);

    $fJobIncomePrice = 3000;
    $fJobIncomePIA = 1200;

    $rStatement->bind_param("ddii", $fJobIncomePrice, $fJobIncomePIA, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fJobIncomePrice = 5000;
    $fJobIncomePIA = 2000;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE JOB_OUTCOME>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."JOB_OUTCOME
    (JOB_OUTCOME_EXPENSES,
    JOB_OUTCOME_DAMAGE,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?);";

    $rStatement->prepare($sQuery);

    $fJobOutcomeExpenses = -500;
    $fJobOutcomeDamage = -1200;

    $rStatement->bind_param("ddii", $fJobOutcomeExpenses, $fJobOutcomeDamage, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fJobOutcomeExpenses = -1000;
    $fJobOutcomeDamage = -700;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE JOB_DATA>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."JOB_DATA
    (JOB_DATA_TITLE,
    JOB_DATA_DATE,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?);";

    $rStatement->prepare($sQuery);

    $sJobDataTitle = "Video Editing";
    $sJobDataDate = "1970-1-1";

    $rStatement->bind_param("ssii", $sJobDataTitle, $sJobDataDate, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $sJobDataTitle = "Recording Studio";
    $sJobDataDate = "1970-1-1";

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE JOB>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."JOB
    (JOB_DATA_ID,
    COMPANY_ID,
    JOB_INCOME_ID,
    JOB_OUTCOME_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?,?,?);";

    $rStatement->prepare($sQuery);

    $iJobDataID = 1;
    $iCompanyID = 1;
    $iJobIncomeID = 1;
    $iJobOutcomeID = 1;

    $rStatement->bind_param("iiiiii", $iJobDataID, $iCompanyID, $iJobIncomeID, $iJobOutcomeID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iJobDataID = 2;
    $iCompanyID = 1;
    $iJobIncomeID = 2;
    $iJobOutcomeID = 2;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    /*--------<INSERT DATA TO TABLE JOB_ASSIGMENT>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."JOB_ASSIGMENT
    (EMPLOYEE_ID,
    COUNTY_ID,
    JOB_ID,
    CUSTOMER_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?,?,?);";

    $rStatement->prepare($sQuery);

    $iEmployeeID = 1;
    $iCountyID = 1;
    $iJobID = 1;
    $iCustomerID = 1;

    $rStatement->bind_param("iiiiii", $iEmployeeID, $iCountyID, $iJobID, $iCustomerID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $iEmployeeID = 2;
    $iCountyID = 1;
    $iJobID = 2;
    $iCustomerID = 2;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();



    /*--------<INSERT DATA TO TABLE JOB_INCOME_TIME>--------*/
    $sQuery="INSERT INTO ".$InsPrefix."JOB_INCOME_TIME
    (JOB_INCOME_TIME_PIT,
    JOB_INCOME_TIME_DATE,
    JOB_ID,
    ACCESS_LEVEL_ID,
    AVAILABLE_ID)
    VALUES
    (?,?,?,?,?);";

    $rStatement->prepare($sQuery);

    $fJobIncomeTimePIT = 600;
    $sJobIncomeTimeDate = "1970-2-1";
    $iJobID = 1;

    $rStatement->bind_param("dsiii", $fJobIncomeTimePIT, $sJobIncomeTimeDate, $iJobID, $GLOBALS['ACCESS']['CEO'], $GLOBALS['AVAILABLE']['SHOW']);

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fJobIncomeTimePIT = 200;
    $sJobIncomeTimeDate = "1970-3-1";
    $iJobID = 1;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fJobIncomeTimePIT = 400;
    $sJobIncomeTimeDate = "1970-2-1";
    $iJobID = 2;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);


    $fJobIncomeTimePIT = 700;
    $sJobIncomeTimeDate = "1970-3-1";
    $iJobID = 2;

    if(!$rStatement->execute())
        $InrInstallationErrorLog->AddLogMessage("Failed to execute query", __FILE__, __FUNCTION__, __LINE__);

    $InrConn->Commit();

    $rStatement->close();
}
?>
