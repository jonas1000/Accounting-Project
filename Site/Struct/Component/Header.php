<?php
$rErrorProcFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rErrorProcLogHandle = new ME_CLogHandle($rErrorProcFileHandle, "LoginProcess", __FILE__);

$DBConn = new ME_CDBConnManager($rErrorProcLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLHeader(ME_CDBConnManager &$InrDBConn, ME_CLogHandle &$InrLogHandle)
{
	//Header Box
	print("
	<div class='Header'>
		<div>
			<div class='HeaderTitle'>");

	if(isset($_GET['MenuIndex']))
		printf("<h1>%s</h1>", array_search($_GET['MenuIndex'], $GLOBALS['MENU_INDEX']));
	else
		print("<h1>Home</h1>");

	print("	</div>");

	HTMLHeaderLogin($InrDBConn, $InrLogHandle);

	print("
		</div>
	</div>");
}

function HTMLHeaderLogin(ME_CDBConnManager &$InrDBConn, ME_CLogHandle &$InrLogHandle)
{
	//Header check state of user connection and display connected or not in the login box
	if(!isset($_GET['Login']))
	{
		//If $_GET['Logout'] is not set then check if $_SESSION['LogedIn'] is set, else display login form
		if(!isset($_GET['Logout']))
		{
			if(isset($_SESSION['LogedIn']))
			{
				if($_SESSION['LogedIn'])
					ProFunctionCallback($InrLogHandle,"HTMLLogedIn", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
			}
			else
				ProFunctionCallback($InrLogHandle, "HTMLLoginForm", $GLOBALS['ACCESS']['GUEST'], "GET");
		}
		else
		{
			require_once("Struct/Module/Session/Logout.php");
			ProFunctionCallback($InrLogHandle, "Logout", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");

			header("Location:.");
		}
	}
	else
	{
		require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
		require_once("../MedaLib/Function/Filter/ConnFilter/StatementFilter.php");
		require_once("../MedaLib/Function/SQL/SQLStatementExec.php");
		require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
		require_once("Process/ProCheck/ProLoginCheck.php");

		ProQueryFunctionCallback($InrDBConn, $InrLogHandle, "LoginCheck", $GLOBALS['ACCESS']['GUEST'], "POST");

		header("Location:Index.php");
	}
}

HTMLHeader($DBConn, $rErrorProcLogHandle);
?>
