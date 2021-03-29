<?php
function Logout()
{
  if($_SESSION['LogedIn'])
    session_unset();
  else
    throw new Exception("Request denied, User is not loged in");
}
?>