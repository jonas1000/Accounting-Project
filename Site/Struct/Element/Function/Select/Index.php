<?php

if(isset($_GET['MenuIndex']))
  header("Location:../../../../Index.php?MenuIndex=".$_GET['MenuIndex']);
else
  header("Location:../../../../Index.php");
?>
