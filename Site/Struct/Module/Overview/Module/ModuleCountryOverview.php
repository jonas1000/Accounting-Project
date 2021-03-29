<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "CountryProcess", __FILE__);

//This is the connection to the database using the MedaLib Folder classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if(!isset($_GET['Module']))
	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLCountryOverview", $GLOBALS['ACCESS']['Employee'], "GET");
else
{
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case $GLOBALS['MODULE']['Add']:
		{
			//If the form was completed from the add form then execute the process to at those data in the database.
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/CountryAddParser.php");
				require_once("Process/ProAdd/ProAddCountry.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProAddCountry", $GLOBALS['ACCESS']['Employee'], "POST");

				header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['Country']));
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/AddForm/CountryAddForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLCountryAddForm", $GLOBALS['ACCESS']['Employee'], "GET");
			}

			break;
		}
		case $GLOBALS['MODULE']['Edit']:
		{
			//If the form was completed from the Edit form then execute the process and Edit those data in the database.
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/CountryEditParser.php");
				require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
				require_once("Process/ProEdit/ProEditCountry.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProEditCountry", $GLOBALS['ACCESS']['Employee'], "POST");

				header("Location:.?MenuIndex=".urlencode($GLOBALS['MENU_INDEX']['Country']));
			}
			else
			{
				require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/CountryEditForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLCountryEditForm", $GLOBALS['ACCESS']['Employee'], "POST");
			}

			break;
		}
		case $GLOBALS['MODULE']['Delete']:
		{
			//Execute the process and edit the show flag data in the database.
			require_once("Input/Parser/VisibilityParser/CountryVisParser.php");
			require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
			require_once("Process/ProDel/ProDelCountry.php");

			ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProDelCountry", $GLOBALS['ACCESS']['Employee'], "POST");
			
			header("Location:Index.php?MenuIndex=" . urlencode($GLOBALS['MENU_INDEX']['Country']));
			
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
