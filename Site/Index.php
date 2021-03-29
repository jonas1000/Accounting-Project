<?php
require_once("Data/HeaderData/HeaderData.php");
require("Data/ConnData/DBSessionToken.php");

session_start();

require_once("Data/GlobalData.php");
require_once("Data/ConnData/DBConnData.php");
require_once("../MedaLib/Class/Handle/FileHandle.php");
require_once("../MedaLib/Class/Handle/LogHandle.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
?>

<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset=utf8>
<link rel='icon' href='../images/FaviconPlaceholder.png' type='image/png'>
<link rel='stylesheet' href='../css/Device/Desktop/DesktopMediaRule.css'>
<link rel='stylesheet' href='../css/Header.css'>
<link rel='stylesheet' href='../css/Body.css'>
<link rel='stylesheet' href='../css/Content.css'>
<link rel='stylesheet' href='../css/Footer.css'>
<link rel='stylesheet' href='../css/MainMenu.css'>

<?php
//Header include
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");
require_once("Struct/Module/Form/LoginForm.php");

//Content Include
require_once("Data/HeaderData/HeaderData.php");
require_once("Data/ConnData/DBSessionToken.php");

//Flow root
if(isset($_GET['MenuIndex']))
{
    require_once("../MedaLib/Class/Manager/DBConnManager.php");
    require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
    require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
    require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

    printf("<title>%s</title>", array_search($_GET['MenuIndex'], $GLOBALS['MENU_INDEX']));

    switch($_GET['MenuIndex'])
    {
        //Access Error
        case $GLOBALS['MENU_INDEX']['AccessError']:
            break;

        //Company
        case $GLOBALS['MENU_INDEX']['Company']:
            require_once("Function/AccessLevelCheck.php");

            //This is to minimize the search and load time as well as the allocation and definition of functions and variables that are not needed for the rest of the script to work.
            require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
            require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Country
        case $GLOBALS['MENU_INDEX']['Country']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Employee
        case $GLOBALS['MENU_INDEX']['Employee']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //EmployeePosition
        case $GLOBALS['MENU_INDEX']['EmployeePosition']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Job
        case $GLOBALS['MENU_INDEX']['Job']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Shareholder
        case $GLOBALS['MENU_INDEX']['Shareholder']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //Customer
        case $GLOBALS['MENU_INDEX']['Customer']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;

        //County
        case $GLOBALS['MENU_INDEX']['County']:
            require_once("Function/AccessLevelCheck.php");
            require_once("../MedaLib/Function/Generator/QuerySearchConstructor.php");
            require_once("../MedaLib/Function/Tool/RangeCheck.php");
            break;
    }
}
else
{
    print("<title>Home</title>");
    print("<script src='../js/IncomeReport.js'></script>");
    print("<script src='../js/Canvas.js'></script>");
}
?>

<script src='../js/Main.js'></script>
<script src='../js/MenuDisplay.js'></script>

</head>

<body onload='Main()'>

<?php
//Main Menu
require_once("Struct/Component/MainMenu.php");
?>

<div class=Wrapper>

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