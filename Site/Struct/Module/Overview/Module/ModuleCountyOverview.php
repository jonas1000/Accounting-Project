<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "CountyProcess", __FILE__);

//This is the connection to the database using the MedaLib classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function CouAddStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//If the form was completed from the add form then execute the process to at those data in the database.
	if(isset($_GET['ProAdd']))
	{
		require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
		require_once("Input/Parser/AddParser/CountyAddParser.php");
		require_once("Process/ProAdd/ProAddCounty.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProAddCounty", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

		header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU']['COUNTY']['INDEX']), $http_response_header=200);
	}
	else
	{
		require_once("Output/Retriever/CountryRetriever.php");
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
		require_once("Struct/Element/Function/Select/SelectCountryRowRender.php");
		require_once("Struct/Module/Form/AddForm/CountyAddForm.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "HTMLCountyAddForm", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
	}
}

function CouEditStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//If the form was completed from the Edit form then execute the process and Edit those data in the database.
	require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

	if(isset($_GET['ProEdit']))
	{
		require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
		require_once("Input/Parser/EditParser/CountyEditParser.php");
		require_once("Output/SpecificRetriever/CountySpecificRetriever.php");
		require_once("Process/ProEdit/ProEditCounty.php");
		
		ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProEditCounty", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

		header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU']['COUNTY']['INDEX']), $http_response_header=200);
	}
	else
	{
		require_once("Output/SpecificRetriever/CountySpecificRetriever.php");
		require_once("Output/Retriever/CountryRetriever.php");
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Struct/Element/Function/Select/SelectCountryRowRender.php");
		require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
		require_once("Struct/Module/Form/EditForm/CountyEditForm.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "HTMLCountyEditForm", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");
	}
}

function CouDeleteStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//Execute the process and edit the show flag data in the database.
	require_once("Input/Parser/VisibilityParser/CountyVisParser.php");
	require_once("Output/SpecificRetriever/CountySpecificRetriever.php");
	require_once("Process/ProDel/ProDelCounty.php");

	ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProDelCounty", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

	header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU']['COUNTY']['INDEX']), $http_response_header=200);
}

function CouOverviewStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case $GLOBALS['MODULE']['ADD']:
		{
			CouAddStructSolver($rConn, $rProcessLogHandle);

			break;
		}
		case $GLOBALS['MODULE']['EDIT']:
		{
			CouEditStructSolver($rConn, $rProcessLogHandle);

			break;
		}
		case $GLOBALS['MODULE']['DELETE']:
		{
			CouDeleteStructSolver($rConn, $rProcessLogHandle);

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
{
	require_once("Output/Retriever/CountyRetriever.php");
	
	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLCountyOverview", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
}
else
	CouOverviewStructSolver($rConn, $rProcessLogHandle);

$rProcessLogHandle->WriteToFileAndClear();
?>