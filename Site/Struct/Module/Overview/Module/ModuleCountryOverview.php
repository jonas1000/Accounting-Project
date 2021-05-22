<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "CountryProcess", __FILE__);

//This is the connection to the database using the MedaLib classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function CounAddStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//If the form was completed from the add form then execute the process to at those data in the database.
	if(isset($_GET['ProAdd']))
	{
		require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
		require_once("Input/Parser/AddParser/CountryAddParser.php");
		require_once("Process/ProAdd/ProAddCountry.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProAddCountry", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

		header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU']['COUNTRY']['INDEX']), $http_response_header=200);
	}
	else
	{
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
		require_once("Struct/Module/Form/AddForm/CountryAddForm.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "HTMLCountryAddForm", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
	}
}

function CounEditStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//If the form was completed from the Edit form then execute the process and Edit those data in the database.
	require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

	if(isset($_GET['ProEdit']))
	{
		require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
		require_once("Input/Parser/EditParser/CountryEditParser.php");
		require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
		require_once("Process/ProEdit/ProEditCountry.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProEditCountry", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

		header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU']['COUNTRY']['INDEX']), $http_response_header=200);
	}
	else
	{
		require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
		require_once("Struct/Module/Form/EditForm/CountryEditForm.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "HTMLCountryEditForm", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");
	}
}

function CounDeleteStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//Execute the process and edit the show flag data in the database.
	require_once("Input/Parser/VisibilityParser/CountryVisParser.php");
	require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
	require_once("Process/ProDel/ProDelCountry.php");

	ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProDelCountry", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");
	
	header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU']['COUNTRY']['INDEX']), $http_response_header=200);
}

function CounOverviewStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case $GLOBALS['MODULE']['ADD']:
		{
			CounAddStructSolver($InrConn, $InrLogHandle);

			break;
		}
		case $GLOBALS['MODULE']['EDIT']:
		{
			CounEditStructSolver($InrConn, $InrLogHandle);

			break;
		}
		case $GLOBALS['MODULE']['DELETE']:
		{
			CounDeleteStructSolver($InrConn, $InrLogHandle);
			
			break;
		}
		default:
		{
			header("Location:.");
			break;
		}
	}
}

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if(!isset($_GET['Module']))
	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLCountryOverview", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
else
	CounOverviewStructSolver($rConn, $rProcessLogHandle);

$rProcessLogHandle->WriteToFileAndClear();
?>
