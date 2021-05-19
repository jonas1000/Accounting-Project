<?php
try
{
	session_start();

	require_once("../Site/Data/HeaderData/HeaderData.php");
	require_once("../Site/Data/GlobalData.php");
	require_once("../Site/Data/ConnData/DBConnData.php");
	require_once("../MedaLib/Class/Manager/DBConnManager.php");
	require_once("../MedaLib/Class/Handle/FileHandle.php");
	require_once("../MedaLib/Class/Handle/LogHandle.php");

	require_once("Tables.php");
	require_once("ViewTables.php");
	require_once("EssentialData.php");
	require_once("DemoData.php");

	error_reporting(E_ALL);

	if(isset($_SESSION['Debug']) && $_SESSION['Debug'] == TRUE)
		ini_set("display_errors", 0);
	else if(isset($_SESSION['Debug']) && $_SESSION['Debug'] == FALSE)
		ini_set("display_errors", 1);

	$ServerDNS = $_SESSION['ServerDNS'];
	$DBName = $_SESSION['DBName'];
	$DBUsername = $_SESSION['DBUsername'];
	$DBPassword = $_SESSION['DBPassword'];
	$sPrefix = $_SESSION['DBPrefix'];

	$rInstalationFileLog = new ME_CFileHandle("InstallationErrorLog.txt", "../Site/Logs", "a");

	$rDBConnManagerErrorLog = new ME_CLogHandle($rInstalationFileLog, "DBErrorLog");
	$rInstallationErrorLog = new ME_CLogHandle($rInstalationFileLog, "InstallationErrorLog");

	$rConn = new ME_CDBConnManager($rDBConnManagerErrorLog, $DBName, $ServerDNS, $DBUsername, $DBPassword, $sPrefix);

	if($rConn->bFailedToConnect)
	{
		$rInstallationErrorLog->AddLogMessage("Error While Initializing the Database connection", __FILE__, __FUNCTION__, __LINE__);

		exit("Failed to connect, check error log for more information");
	}

	print("
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset=utf8>
		</head>
		<body>");


	CreateTables($rConn, $rInstallationErrorLog, $sPrefix, $DBName);

	print("<br><h1>TABLES - COMPLETE</h1><br>");


	CreateViewTables($rConn, $rInstallationErrorLog, $sPrefix);

	printf("<br><h1>VIEW TABLE - COMPLETE</h1><br>");

	InsertEssentialData($rConn, $sPrefix);

	print("<br><h1>ESSESTIAL DATA - COMPLETE</h1><br>");

	InsertDemoData($rConn, $rInstallationErrorLog, $sPrefix);

	print("<br><h1>DEMO DATA - COMPLETE</h1><br>");
	
	if(session_unset())
		print("<br>Session Nullified");
	else
		print("<br>Failed to Nullified sessions");

	if(session_destroy())
		print("<br>Destroy session");
	else
		print("<br>Failed to Destroy session");

	print("</body></html>");

	$rInstallationErrorLog->WriteToFileAndClear();
	$rDBConnManagerErrorLog->WriteToFileAndClear();
}
catch(Exception $Error)
{
	$rInstalationFileLog = new ME_CFileHandle("InstallationErrorLog.txt", "../Site/Logs", "a");
	
	$rExceptionLog = new ME_CLogHandle($rInstalationFileLog, "InstallationExceptionLog", __FILE__);

	$rExceptionLog->AddLogMessage($Error->getMessage(), __FILE__, "None", $Error->getLine());

	$rExceptionLog->WriteToFileAndClear();
}
?>
