<?php

require_once("../../../Data/HeaderData/HeaderData.php");
require_once("../../../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../../Data/GlobalData.php");
require_once("../../../Process/ProErrorLog/ProCallbackErrorLog.php");
require_once("../../../MedaLib/Log/LogSystem.php");
require_once("../../../MedaLib/Filter/SecurityFilter/SecurityFilter.php");

function Logout()
{
  if($_SESSION['LogedIn'])
  {
    session_unset();

    header("Location:../../../Index.php");
  }
  else
    throw new Exception("Request denied, User is not loged in");
}

ProFunctionCallback("Logout", $_ENV['AccessLevel']['Employee'], $_SERVER['REQUEST_METHOD'], "../../../Logs");

?>
