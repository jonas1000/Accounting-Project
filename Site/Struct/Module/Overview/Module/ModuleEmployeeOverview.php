<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "EmployeeProcess", __FILE__);

//This is the connection to the database using the MedaLib classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if(!isset($_GET['Module']))
{
	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLEmployeeOverview", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
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
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/AddParser/EmployeeAddParser.php");
				require_once("Process/ProAdd/ProAddEmployee.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProAddEmployee", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

				header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['EMPLOYEE']), $http_response_header=200);
			}
			else
			{
				require_once("Output/Retriever/CompanyRetriever.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
				require_once("Struct/Element/Function/Select/SelectEmployeePositionRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/AddForm/EmployeeAddForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLEmployeeAddForm", $GLOBALS['ACCESS']['EMPLOYEE'], "GET");
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
				require_once("Input/Parser/EditParser/EmployeeEditParser.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
				require_once("Process/ProEdit/ProEditEmployee.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProEditEmployee", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

				header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['EMPLOYEE']), $http_response_header=200);
			}
			else
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Output/Retriever/CompanyRetriever.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
				require_once("Struct/Element/Function/Select/SelectEmployeePositionRowRender.php");
				require_once("Struct/Module/Form/EditForm/EmployeeEditForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLEmployeeEditForm", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");
			}

			break;
		}
		case $GLOBALS['MODULE']['DELETE']:
		{
			//Execute the process and edit the show flag data in the database.
			require_once("Input/Parser/VisibilityParser/EmployeeVisParser.php");
			require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
			require_once("Process/ProDel/ProDelEmployee.php");

			ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProDelEmployee", $GLOBALS['ACCESS']['EMPLOYEE'], "POST");

			header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['EMPLOYEE']), $http_response_header=200);

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