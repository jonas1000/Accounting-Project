<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLEmployeePositionOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/EmployeeRetriever.php");

	EmployeePositionRetriever($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $EmpPosRow => $EmpPosData)
	{
			print("<div class='DataBlock'>");

			print("<form method='POST'>");
			print("<div>");

			print("<div>");
			printf("<h5>%s<h5>", $EmpPosData['EMP_POS_TITLE']);
			print("</div>");

			print("</div>");

			print("<div>");
			printf("<input type='hidden' name='EmpPosIndex' value='%s'>", $EmpPosData['EMP_POS_ID']);
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
	ProQueryFunctionCallback($DBConn, "HTMLEmployeePositionOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/EmployeePositionAddParser.php");
				require_once("Process/ProAdd/ProAddEmployeePosition.php");

				ProQueryFunctionCallback($DBConn, "ProAddEmployeePosition", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/EmployeePositionAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLEmployeePositionAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}

			break;
		}
		case 1:
		{
            require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/EmployeePositionEditParser.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("process/ProEdit/ProEditEmployeePosition.php");

                ProQueryFunctionCallback($DBConn, "ProEditEmployeePosition", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/EmployeePositionEditForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLEmployeePositionEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/EmployeePositionVisParser.php");
			require_once("Process/ProDel/ProDelEmployeePosition.php");

			ProQueryFunctionCallback($DBConn, "ProDelEmployeePosition", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

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