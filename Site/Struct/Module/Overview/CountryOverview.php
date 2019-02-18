<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCountryOverview(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/CountryRetriever.php");

	CountryGeneralRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CountryRow => $CountryData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			printf("<div>");

			//Title
			printf("<div>");
			printf("<h5>".$CountryData['COUN_DATA_TITLE']."</h5>");
			printf("</div>");

			printf("</div>");

			printf("<div>");
			printf("<input type='hidden' name='CounIndex' value=".$CountryData['COUN_ID'].">");
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=2'>");
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=1'>");
			printf("</div>");
			printf("</form>");

			printf("</div>");
	}

	printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&Module=0'><div class='Button-Left'><h5>Add</h5></div></a>");
}

//-------------<PHP-HTML>-------------//
if(!isset($_GET['Module']))
	ProQueryFunctionCallback($DBConn, "HTMLCountryOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
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
			require_once("Input/Parser/EditParser/CountryEditParser.php");
			require_once("Struct/Module/Form/EditForm/CountryEditForm.php");

			ProQueryFunctionCallback($DBConn, "HTMLCountryEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
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
