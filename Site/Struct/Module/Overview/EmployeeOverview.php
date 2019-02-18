<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLEmployeeOverview(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/EmployeeRetriever.php");

	EmployeeOverviewRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $EmployeeRow => $EmployeeData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			printf("<div>");

			//Title
			printf("<div>");
			printf("<h5>".$EmployeeData['EMP_DATA_NAME']." ".$EmployeeData['EMP_DATA_SURNAME']."</h5>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Email</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$EmployeeData['EMP_DATA_EMAIL']."</p>");
			printf("</div>");
			printf("</div>");

			if(($_SESSION['AccessID'] - 1) < $_ENV['AccessLevel']['CEO'])
			{
				//Data Row
				printf("<div>");
				printf("<div>");
				printf("<b><p>Salary</p></b>");
				printf("</div>");

				printf("<div>");
				printf("<p>".$EmployeeData['EMP_DATA_SAL']."<p>");
				printf("</div>");
				printf("</div>");
			}

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Title</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$EmployeeData['EMP_POS_TITLE']."<p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Birth Day</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$EmployeeData['EMP_DATA_BDAY']."<p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Phone Number</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$EmployeeData['EMP_DATA_PN']."<p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Stable Number</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$EmployeeData['EMP_DATA_SN']."<p>");
			printf("</div>");
			printf("</div>");

			printf("</div>");

			printf("<div>");
			printf("<input type='hidden' name='EmpIndex' value=".$EmployeeData['EMP_ID'].">");
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=2' >");
			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=1'>");
			printf("</div>");

			printf("</form>");

			printf("</div>");
	}

	printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."&Module=0'><div class='Button-Left'><h5>Add</h5></div></a>");
}

//-------------<PHP-HTML>-------------//
if(!isset($_GET['Module']))
	ProQueryFunctionCallback($DBConn, "HTMLEmployeeOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
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
			if(isset($_GET['EditPro']))
			{
				ProQueryFunctionCallback($DBConn, "ProEditEmployee", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
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