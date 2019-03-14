<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCountryOverview(ME_CDBConnManager &$InDBConn, &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/CountryRetriever.php");

	CountryGeneralRetriever($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CountryRow => $CountryData)
	{
			print("<div class='DataBlock'>");

			print("<form method='POST'>");
			print("<div>");

			//Title
			print("<div>");
			printf("<h5>%s</h5>", $CountryData['COUN_DATA_TITLE']);
			print("</div>");

			print("</div>");

			print("<div>");
			printf("<input type='hidden' name='CounIndex' value='%s'>", $CountryData['COUN_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%s&Module=2'>", $_GET['MenuIndex']);
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%s&Module=1'>", $_GET['MenuIndex']);
			print("</div>");
			print("</form>");

			print("</div>");
	}

	printf("<a href='.?MenuIndex=%s&Module=0'><div class='Button-Left'><h5>Add</h5></div></a>", $_GET['MenuIndex']);
}

//-------------<PHP-HTML>-------------//
if(!isset($_GET['Module']))
	ProQueryFunctionCallback($DBConn, "HTMLCountryOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/CountryAddParser.php");
				require_once("Process/ProAdd/ProAddCountry.php");

				ProQueryFunctionCallback($DBConn, "ProAddCountry", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/CountryAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLCountryAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}

			break;
		}
		case 1:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/CountryEditParser.php");
				require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
				require_once("Process/ProEdit/ProEditCountry.php");

				ProQueryFunctionCallback($DBConn, "ProEditCountry", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/SpecificRetriever/CountrySpecificRetriever.php");
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/CountryEditForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLCountryEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/CountryVisParser.php");
			require_once("Process/ProDel/ProDelCountry.php");

			ProQueryFunctionCallback($DBConn, "ProDelCountry", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			
			break;
		}
		default:
		{
			header("Location:.");
			break;
		}
	}

unset($DBConn);
?>
