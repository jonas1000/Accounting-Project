<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCustomerOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/CustomerRetriever.php");

	CustomerGeneralRetriever($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CustRow => $CustData)
	{
			print("<div class='DataBlock'>");

			print("<form method='POST'>");
			//Data div block
			print("<div>");

			print("<div>");
			printf("<h5>%s %s</h5>", $CustData['CUST_DATA_NAME'], $CustData['CUST_DATA_SURNAME']);
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Email</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", (empty($CustData['CUST_DATA_EMAIL']) ? "None" : $CustData['CUST_DATA_EMAIL']));
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Phone number</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", (empty($CustData['CUST_DATA_PN']) ? "None" : $CustData['CUST_DATA_PN']));
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Stable number</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", (empty($CustData['CUST_DATA_SN']) ? "None" : $CustData['CUST_DATA_SN']));
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>VAT</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", (empty($CustData['CUST_DATA_VAT']) ? "None" : $CustData['CUST_DATA_VAT']));
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Address</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", (empty($CustData['CUST_DATA_ADDR']) ? "None" : $CustData['CUST_DATA_ADDR']));
			print("</div>");
			print("</div>");

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Note</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", (empty($CustData['CUST_DATA_NOTE']) ? "None" : $CustData['CUST_DATA_NOTE']));
			print("</div>");
			print("</div>");

			print("</div>");

			//Input Block
			print("<div>");
			printf("<input type='hidden' name='CustIndex' value='%s'>", $CustData['CUST_ID']);
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
	ProQueryFunctionCallback($DBConn, "HTMLCustomerOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/CustomerAddParser.php");

				ProQueryFunctionCallback($DBConn, "ProAddCustomer", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/CustomerAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLCustomerAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}

			break;
		}
		case 1:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("Input/parser/EditParser/CustomerEditParser.php");
				require_once("Output/Retriever/CustomerRetriever.php");
				require_once("Process/ProEdit/ProEditCustomer.php");
				
				ProQueryFunctionCallback($DBConn, "ProEditCustomer", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/SpecificRetriever/AccessSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/CustomerEditForm.php");
				
				ProQueryFunctionCallback($DBConn, "HTMLCustomerEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

			break;
		}
		case 2:
		{
			require_once("Process/ProDel/ProDelCustomer.php");

			ProQueryFunctionCallback($DBConn, "ProDelCustomerParser", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			
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
