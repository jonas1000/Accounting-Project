<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "ShareholderProcess", __FILE__);

//This is the connection to the database using the MedaLib classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if(!isset($_GET['Module']))
{
	require_once("Output/Retriever/ShareholderRetriever.php");

	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLShareholderOverview", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
}
else
{
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case $GLOBALS['MODULE']['ADD']:
		{
			//If the form was completed from the add form then execute the process to at those data in the database.
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/ShareholderAddParser.php");
				require_once("Process/ProAdd/ProAddShareholder.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProAddShareholder", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

				header("Location:Index.php?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['SHAREHOLDER']), $http_response_header=200);
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Struct/Element/Function/Select/SelectEmployeeRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/AddForm/ShareholderAddForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLShareholderAddForm", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
			}
			break;
		}
		case $GLOBALS['MODULE']['EDIT']:
		{
			//If the form was completed from the Edit form then execute the process and Edit those data in the database.
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/ShareholderEditParser.php");
				require_once("Output/SpecificRetriever/ShareholderSpecificRetriever.php");
				require_once("Process/ProEdit/ProEditShareholder.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProEditShareholder", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

				header("Location:Index.php?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['SHAREHOLDER']), $http_response_header=200);
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Output/SpecificRetriever/ShareholderSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectEmployeeRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/ShareholderEditForm.php");
				
				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLShareholderEditForm", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");
			}

			break;
		}
		case $GLOBALS['MODULE']['DELETE']:
		{
			//Execute the process and edit the show flag data in the database.
			require_once("Input/Parser/VisibilityParser/ShareholderVisParser.php");
			require_once("Process/ProDel/ProDelShareholder.php");

			ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProDelShareholder", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

			header("Location:Index.php?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['SHAREHOLDER']), $http_response_header=200);

			break;
		}
		default:
		{
			header("Location:.");
			break;
		}
	}
}

$rProcessLogHandle->WriteToFileAndClear();
?>
