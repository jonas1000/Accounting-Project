<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLEmployeeOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/EmployeeRetriever.php");

	EmployeeOverviewRetriever($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $EmployeeRow => $EmployeeData)
	{
			print("<div class='DataBlock'>");

			print("<form method='POST'>");
			print("<div>");

			//Title
			print("<div>");
			printf("<h5>%s %s</h5>", $EmployeeData['EMP_DATA_NAME'], $EmployeeData['EMP_DATA_SURNAME']);
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Email</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", $EmployeeData['EMP_DATA_EMAIL']);
			print("</div>");
			print("</div>");

			if(($_SESSION['AccessID'] - 1) < $_ENV['AccessLevel']['CEO'])
			{
				//Data Row
				print("<div>");
				print("<div>");
				print("<b><p>Salary</p></b>");
				print("</div>");

				print("<div>");
				printf("<p>%s<p>", $EmployeeData['EMP_DATA_SALARY']);
				print("</div>");
				print("</div>");
			}

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Title</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s<p>", $EmployeeData['EMP_POS_TITLE']);
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Birth Day</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s<p>", $EmployeeData['EMP_DATA_BDAY']);
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Phone Number</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s<p>", $EmployeeData['EMP_DATA_PN']);
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Stable Number</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s<p>", $EmployeeData['EMP_DATA_SN']);
			print("</div>");
			print("</div>");

			print("</div>");

			print("<div>");
			printf("<input type='hidden' name='EmpIndex' value='%s'>", $EmployeeData['EMP_ID']);
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
	ProQueryFunctionCallback($DBConn, "HTMLEmployeeOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/EmployeeAddParser.php");
				require_once("Process/ProAdd/ProAddEmployee.php");

				ProQueryFunctionCallback($DBConn, "ProAddEmployee", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/EmployeeAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLEmployeeAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}
			
			break;
		}
		case 1:
		{
            require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/EmployeeEditParser.php");
				require_once("Output/Retriever/EmployeeRetriever.php");
				require_once("Output/SpecificRetriever/EmployeeSpecificRetriever.php");
				require_once("Process/ProEdit/ProEditEmployee.php");

				ProQueryFunctionCallback($DBConn, "ProEditEmployee", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
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

				ProQueryFunctionCallback($DBConn, "HTMLEmployeeEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/EmployeeVisParser.php");
			require_once("Process/ProDel/ProDelEmployee.php");

			ProQueryFunctionCallback($DBConn, "ProDelEmployee", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

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