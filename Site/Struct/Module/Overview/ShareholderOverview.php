<?php
//Only load scripts and libraries heir if your sure that at least 2 or more of the functions inside the scripts are always required
//This is to minimize the search and load time as well as the allocation and definition of functions and variables that are not needed for the rest of the script to work.
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

//This is the connection to the database using the MedaLib Folder classes.
$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLShareholderOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
	//Number of division for the list the query returns
	$iNumberRowDivision = 4;

	//Array counter to do proper modulo operation for row division
	$iCounter = 0;

	ShareholderOverviewRetriever($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);

	//The toolbar for the buttons (tools)
	print("<div class='ContentToolBar'>");
	printf("<a href='.?MenuIndex=%s&Module=0'><div class='Button-Left'><h5>ADD</h5></div></a>", $_GET['MenuIndex']);
	print("</div>");

	//The number of rows that the query returned
	$iJobNumRows = $InDBConn->GetResultNumRows();

	foreach($InDBConn->GetResult() as $ShareRow => $ShareData)
	{
		//Do a modulo operation to divide the rows by the number of row divisions
		$iCounterModuloOperation = $iCounter % $iNumberRowDivision;

		$iCounter++;

		//Check if it is the first row, else execute every 0 of modulo result
		if(($iCounterModuloOperation < 1) && !($iCounter > 1))
			print("<div class='ContentArrayBlock'>");
		else if($iCounterModuloOperation < 1)
		{
			print("</div>");
			print("<div class='ContentArrayBlock'>");
		}

		print("<div class='DataBlock'>");

		print("<form method='POST'>");
		print("<div>");

		//Title
		print("<div>");
		printf("<h5>%s %s</h5>", $ShareData['EMP_DATA_NAME'], $ShareData['EMP_DATA_SURNAME']);
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Salary</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $ShareData['EMP_DATA_SALARY']);
		print("</div>");
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Birth Date</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $ShareData['EMP_DATA_BDAY']);
		print("</div>");
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Email</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $ShareData['EMP_DATA_EMAIL']);
		print("</div>");
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Title</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $ShareData['EMP_POS_TITLE']);
		print("</div>");
		print("</div>");

		print("</div>");

		//Button list for specific Data Row
		print("<div>");
		printf("<input type='hidden' name='ShareIndex' value='%s'>", $ShareData['SHARE_ID']);
		printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%s&Module=2'>", $_GET['MenuIndex']);
		printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%s&Module=1'>", $_GET['MenuIndex']);
		print("</div>");
		print("</form>");

		print("</div>");

		//If array counter is equal to the length of the rows the query returned,
		//then that means that this is the last ContentArrayBlock and it needs to wrap it
		//to prevent the html elements to break.
		if($iCounter == $iJobNumRows) 
			print("</div>");
	}

	unset($iUserAccessLevel, $iNumberRowDivision, $iCounter, $iShareholderNumRows, $iCounterModuloOperation);
}

//-------------<PHP-HTML>-------------//

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if(!isset($_GET['Module']))
{
	require_once("Output/Retriever/ShareholderRetriever.php");

	ProQueryFunctionCallback($DBConn, "HTMLShareholderOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
}
else
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case 0:
		{
			//If the form was completed from the add form then execute the process to at those data in the database.
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/ShareholderAddParser.php");
				require_once("Process/ProAdd/ProAddShareholder.php");

				ProQueryFunctionCallback($DBConn, "ProAddShareholder", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Struct/Element/Function/Select/SelectEmployeeRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/AddForm/ShareholderAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLShareholderAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}
			break;
		}
		case 1:
		{
			//If the form was completed from the Edit form then execute the process and Edit those data in the database.
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/ShareholderEditParser.php");
				require_once("Output/SpecificRetriever/ShareholderSpecificRetriever.php");
				require_once("Process/ProEdit/ProEditShareholder.php");

				ProQueryFunctionCallback($DBConn, "ProEditShareholder", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Output/SpecificRetriever/ShareholderSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectEmployeeRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/ShareholderEditForm.php");
				
				ProQueryFunctionCallback($DBConn, "HTMLShareholderEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

			break;
		}
		case 2:
		{
			//Execute the process and edit the show flag data in the database.
			require_once("Input/Parser/VisibilityParser/ShareholderVisParser.php");
			require_once("Process/ProDel/ProDelShareholder.php");

			ProQueryFunctionCallback($DBConn, "ProDelShareholder", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			break;
		}
		default:
		{
			header("Location:.");
			break;
		}
	}

unset($DBConn, $_GET['MenuIndex'], $_GET['Module'], $_GET['ProAdd'], $_GET['ProEdit']);
?>
