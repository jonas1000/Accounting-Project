<?php
if(!isset($_SESSION['AccessID'], $_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword']))
{
	if($GLOBALS['DEBUG'])
	{
		$_SESSION['AccessID'] = $GLOBALS['ACCESS']['ADMIN'];

		//The Host server name for establishing the desired connection to the database.
		$_SESSION['ServerDNS'] = "localhost";

		//The database name to connect and execute querys in.
		$_SESSION['DBName'] = "CompanyAccountDB";
		$_SESSION['DBPrefix'] = "AT4553_";

		//The User name and password to the host to be able to access the database.
		$_SESSION['DBUsername'] = "root";
		$_SESSION['DBPassword'] = "";
	}
	else
	{
		$_SESSION['AccessID'] = $GLOBALS['ACCESS']["GUEST"];

		//The Host server name for establishing the desired connection to the database.
		$_SESSION['ServerDNS'] = "localhost";

		//The database name to connect and execute querys in.
		$_SESSION['DBName'] = "CompanyAccountDB";
		$_SESSION['DBPrefix'] = "AT4553_";

		//The User name and password to the host to be able to access the database.
		$_SESSION['DBUsername'] = "root";
		$_SESSION['DBPassword'] = "";
	}
}
?>
