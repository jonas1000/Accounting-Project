<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "CustomerProcess", __FILE__);

//This is the connection to the database using the MedaLib classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function CustAddStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//If the form was completed from the add form then execute the process to at those data in the database.
	if(isset($_GET['ProAdd']))
	{
		require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
		require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
		require_once("Input/Parser/AddParser/CustomerAddParser.php");
		require_once("Process/ProAdd/ProAddCustomer.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProAddCustomer", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

		header("Location:Index.php?MenuIndex=".urlencode($GLOBALS['MENU']['CUSTOMER']['INDEX']), $http_response_header=200);
	}
	else
	{
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
		require_once("Struct/Module/Form/AddForm/CustomerAddForm.php");

		ProQueryFunctionCallback($InrConn, $InrLogHandle, "HTMLCustomerAddForm", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
	}
}

function CustEditStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//If the form was completed from the Edit form then execute the process and Edit those data in the database.
	require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

	if(isset($_GET['ProEdit']))
	{
		require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
		require_once("Input/parser/EditParser/CustomerEditParser.php");
		require_once("Output/SpecificRetriever/CustomerSpecificRetriever.php");
		require_once("Process/ProEdit/ProEditCustomer.php");
		
		ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProEditCustomer", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

		header("Location:Index.php?MenuIndex=".urlencode($GLOBALS['MENU']['CUSTOMER']['INDEX']), $http_response_header=200);
	}
	else
	{
		require_once("Output/Retriever/AccessRetriever.php");
		require_once("Output/SpecificRetriever/CustomerSpecificRetriever.php");
		require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
		require_once("Struct/Module/Form/EditForm/CustomerEditForm.php");
		
		ProQueryFunctionCallback($InrConn, $InrLogHandle, "HTMLCustomerEditForm", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");
	}
}

function CustDeleteStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//Execute the process and edit the show flag data in the database.
	require_once("Input/Parser/VisibilityParser/CustomerVisParser.php");
	require_once("Output/SpecificRetriever/CustomerSpecificRetriever.php");
	require_once("Process/ProDel/ProDelCustomer.php");

	ProQueryFunctionCallback($InrConn, $InrLogHandle, "ProDelCustomer", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

	header("Location:Index.php?MenuIndex=".urlencode($GLOBALS['MENU']['CUSTOMER']['INDEX']), $http_response_header=200);
}

function CustOverviewStructSolver(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case $GLOBALS['MODULE']['ADD']:
		{
			CustAddStructSolver($InrConn, $InrLogHandle);

			break;
		}
		case $GLOBALS['MODULE']['EDIT']:
		{
			CustEditStructSolver($InrConn, $InrLogHandle);

			break;
		}
		case $GLOBALS['MODULE']['DELETE']:
		{
			CustDeleteStructSolver($InrConn, $InrLogHandle);
			
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
	//require_once("Output/Retriever/CustomerRetriever.php");

	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLCustomerOverview", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
}
else
	CustOverviewStructSolver($rConn, $rProcessLogHandle);

$rProcessLogHandle->WriteToFileAndClear();
?>
