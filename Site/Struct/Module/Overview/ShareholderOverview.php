<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLShareholderOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
	ShareholderOverviewRetriever($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $ShareRow => $ShareData)
	{
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

			print("<div>");
			print("<div>");
			print("<b><p>Email</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", $ShareData['EMP_DATA_EMAIL']);
			print("</div>");
			print("</div>");

			print("<div>");
			print("<div>");
			print("<b><p>Title</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", $ShareData['EMP_POS_TITLE']);
			print("</div>");
			print("</div>");

			print("</div>");

			print("<div>");
			printf("<input type='hidden' name='ShareIndex' value='%s'>", $ShareData['SHARE_ID']);
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
{
	require_once("Output/Retriever/ShareholderRetriever.php");

	ProQueryFunctionCallback($DBConn, "HTMLShareholderOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
}
else
	switch($_GET['Module'])
	{
		case 0:
		{
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

unset($DBConn);
?>
