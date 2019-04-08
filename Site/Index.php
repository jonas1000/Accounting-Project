<?php
require_once("Data/HeaderData/HeaderData.php");
require("Data/ConnData/DBSessionToken.php");

session_start();

require_once("Data/GlobalData.php");
require_once("Data/ConnData/DBConnData.php");

print("<!DOCTYPE html>");
print("<html lang='en'>");

print("<head>");
print("<meta charset=utf8>");
print("<link rel='icon' href='../images/FaviconPlaceholder.png' type='image/png'>");
print("<title>Home</title>");
print("<link rel='stylesheet' href='../css/Device/Desktop/DesktopMediaRule.css'>");
print("<link rel='stylesheet' href='../css/Body.css'>");
print("<link rel='stylesheet' href='../css/Header.css'>");
print("<link rel='stylesheet' href='../css/MainMenu.css'>");
print("<link rel='stylesheet' href='../css/Content.css'>");
print("<link rel='stylesheet' href='../css/Footer.css'>");
print("<link rel='stylesheet' href='../css/Form.css'>");
print("<link rel='stylesheet' href='../css/DataBlock.css'>");
print("</head>");

print("<body onload='Main()'>");

print("<script src='../js/Main.js'></script>");
print("<script src='../js/MenuDisplay.js'></script>");

//Main Menu
require_once("Struct/Component/MainMenu.php");

//wrapper
print("<div class=Wrapper>");

//Header content
require_once("Struct/Component/Header.php");

//Body content
require_once("Struct/Component/Content.php");

//Footer content
require_once("Struct/Component/Footer.php");
print("</div>");

print("</body>");
print("</html>");
?>