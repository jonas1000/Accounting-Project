<?php
require_once("Data/HeaderData/HeaderData.php");
require("Data/ConnData/DBSessionToken.php");

session_start();

require_once("Data/GlobalData.php");
require_once("Data/ConnData/DBConnData.php");

printf("<!DOCTYPE html>");
printf("<html lang='en'>");

printf("<head>");
printf("<meta charset=utf8>");
printf("<link rel='icon' href='../images/FaviconPlaceholder.png' type='image/png'>");
printf("<title>Home</title>");
printf("<link rel='stylesheet' href='../css/Device/Desktop/DesktopMediaRule.css'>");
printf("<link rel='stylesheet' href='../css/Body.css'>");
printf("<link rel='stylesheet' href='../css/Header.css'>");
printf("<link rel='stylesheet' href='../css/MainMenu.css'>");
printf("<link rel='stylesheet' href='../css/Content.css'>");
printf("<link rel='stylesheet' href='../css/Footer.css'>");
printf("<link rel='stylesheet' href='../css/Form.css'>");
printf("<link rel='stylesheet' href='../css/DataBlock.css'>");
printf("</head>");

printf("<body onload='Main()'>");

printf("<script src='../js/Main.js'></script>");
printf("<script src='../js/MenuDisplay.js'></script>");

//Main Menu
require_once("Struct/Component/MainMenu.php");

//wrapper
printf("<div class=Wrapper>");

//Header content
require_once("Struct/Component/Header.php");

//Body content
require_once("Struct/Component/Content.php");

//Footer content
require_once("Struct/Component/Footer.php");
printf("</div>");

printf("</body>");
printf("</html>");

?>
