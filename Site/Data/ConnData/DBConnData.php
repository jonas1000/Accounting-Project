<?php
if(!isset($_SESSION['AppVersion'], $_SESSION['Debug'], $_SESSION['AccessID'], $_SESSION['ConnEncoding'], $_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword']))
{
	$_SESSION['AppVersion'] = "0.2.3.6";

	//WARNING: this variable will be removed in the future
	//it is only used in the current state of development
	$_SESSION['Debug'] = FALSE;

	if($_SESSION['Debug'])
	{
	  $_SESSION['AccessID'] = $_ENV['AccessLevel']['Admin'];

	  //The encoding the connect to the database will use.
	  $_SESSION['ConnEncoding'] = "utf8";

	  //The Host server name for establishing the desired connection to the database.
	  $_SESSION['ServerName'] = "localhost";

	  //The database name to connect and execute querys in.
	  $_SESSION['DBName'] = "CompanyAccountDB";
		$_SESSION['DBPrefix'] = "AT4553_";

	  //The User name and password to the host to be able to access the database.
	  $_SESSION['DBUsername'] = "root";
	  $_SESSION['DBPassword'] = "";
	}
	else
	{
	  $_SESSION['AccessID'] = $_ENV['AccessLevel']["Guest"];

	  //The encoding the connection to the database will use.
	  $_SESSION['ConnEncoding'] = "utf8";

	  //The Host server name for establishing the desired connection to the database.
	  $_SESSION['ServerName'] = "localhost";

	  //The database name to connect and execute querys in.
	  $_SESSION['DBName'] = "CompanyAccountDB";
		$_SESSION['DBPrefix'] = "AT4553_";

	  //The User name and password to the host to be able to access the database.
	  $_SESSION['DBUsername'] = "root";
	  $_SESSION['DBPassword'] = "";
	}
}
?>
