<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLEmployeePositionOverview(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/EmployeeRetriever.php");

	EmployeePositionRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $EmpPosRow => $EmpPosData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			printf("<div>");

			printf("<div>");
			printf("<h5>".$EmpPosData['EMP_POS_TITLE']."<h5>");
			printf("</div>");

			printf("</div>");

			printf("<div>");
			printf("<input type='hidden' name='EmpPosIndex' value=".$EmpPosData['EMP_POS_ID'].">");
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
	ProQueryFunctionCallback($DBConn, "HTMLEmployeePositionOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
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
			require_once("Struct/Module/Form/EditForm/EmployeePositionEditForm.php");

			ProQueryFunctionCallback($DBConn, "HTMLEmployeePositionEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

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