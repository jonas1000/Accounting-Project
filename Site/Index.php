<?php
require_once("Data/HeaderData/HeaderData.php");
require("Data/ConnData/DBSessionToken.php");

session_start();

require_once("Data/GlobalData.php");
require_once("Data/ConnData/DBConnData.php");
require_once("../MedaLib/Class/Handle/FileHandle.php");
require_once("../MedaLib/Class/Handle/LogHandle.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");

//Header include
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");
require_once("Process/ProLogin/ProLogin.php");
require_once("Struct/Module/Form/LoginForm.php");

//Content Include
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf8">
<link rel="icon" href="../images/FaviconPlaceholder.png" type="image/png">
<link rel="stylesheet" href="../css/Device/Desktop/DesktopMediaRule.css">
<link rel="stylesheet" href="../css/Header.css">
<link rel="stylesheet" href="../css/Body.css">
<link rel="stylesheet" href="../css/Content.css">
<link rel="stylesheet" href="../css/Footer.css">
<link rel="stylesheet" href="../css/MainMenu.css">

<?php

if(isset($_GET['Login']))
{
    require_once("../MedaLib/Function/Tool/RangeCheck.php");
    require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
    require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
    require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

    $rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");
    $rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "LoginProcess", __FILE__);

    $rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

    ProLogin($rConn, $rProcessLogHandle);

    $rProcessLogHandle->WriteToFileAndClear();

    unset($rConn, $rProcessFileHandle, $rProcessLogHandle);
}
else if (isset($_GET['Logout']))
{
    $rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");
    $rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "LogoutProcess", __FILE__);

    ProLogout($rProcessLogHandle);

    InitSession();
}
else
    InitSession();

//Flow root
if(isset($_GET['MenuIndex']))
{
    require_once("../MedaLib/Class/Manager/DBConnManager.php");
    require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
    require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
    require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

    switch($_GET['MenuIndex'])
    {
        //Access Error
        case $GLOBALS['MENU']['ERROR']["INDEX"]:
            break;

        //Company
        case $GLOBALS['MENU']['COMPANY']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['COMPANY']['TITLE']);
            require_once("Function/AccessLevelCheck.php");

            //This is to minimize the search and load time as well as the allocation and definition of functions and variables that are not needed for the rest of the script to work.
            require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
            require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Country
        case $GLOBALS['MENU']['COUNTRY']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['COUNTRY']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Employee
        case $GLOBALS['MENU']['EMPLOYEE']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['EMPLOYEE']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Employee Position
        case $GLOBALS['MENU']['EMPLOYEE_POSITION']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['EMPLOYEE_POSITION']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Job
        case $GLOBALS['MENU']['JOB']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['JOB']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Shareholder
        case $GLOBALS['MENU']['SHAREHOLDER']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['SHAREHOLDER']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Customer
        case $GLOBALS['MENU']['CUSTOMER']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['CUSTOMER']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //County
        case $GLOBALS['MENU']['COUNTY']["INDEX"]:
            printf("<title>%s</title>", $GLOBALS['MENU']['COUNTY']['TITLE']);
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        default:
            print("<title>Home</title>
            <script src='../js/IncomeReport.js'></script>
            <script src='../js/Canvas.js'></script>");
            break;
    }
}
else
{
    print("<title>Home</title>
    <script src='../js/IncomeReport.js'></script>
    <script src='../js/Canvas.js'></script>");
}
?>

<script src='../js/Main.js'></script>
<script src='../js/MenuDisplay.js'></script>
<script src="../js/QueryDataTypeControl.js"></script>

</head>

<body onload="Main()">

<?php
//Main Menu
require_once("Struct/Component/MainMenu.php");
?>

<div class="Wrapper">

<?php
//Header content
require_once("Struct/Component/Header.php");

//Body content
require_once("Struct/Component/Content.php");

//Footer content
require_once("Struct/Component/Footer.php");

?>
</div>

</body>
</html>