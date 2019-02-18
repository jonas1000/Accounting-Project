<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCustomerOverview(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/CustomerRetriever.php");

	CustomerGeneralRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CustRow => $CustData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			//Data div block
			printf("<div>");

			printf("<div>");
			printf("<h5>".$CustData['CUST_DATA_NAME']. " " .$CustData['CUST_DATA_SURNAME']."</h5>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Email</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".(empty($CustData['CUST_DATA_EMAIL']) ? "None" : $CustData['CUST_DATA_EMAIL'])."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Phone number</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".(empty($CustData['CUST_DATA_PN']) ? "None" : $CustData['CUST_DATA_PN'])."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Stable number</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".(empty($CustData['CUST_DATA_SN']) ? "None" : $CustData['CUST_DATA_SN'])."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>VAT</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".(empty($CustData['CUST_DATA_VAT']) ? "None" : $CustData['CUST_DATA_VAT'])."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Address</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".(empty($CustData['CUST_DATA_ADDR']) ? "None" : $CustData['CUST_DATA_ADDR'])."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Note</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".(empty($CustData['CUST_DATA_NOTE']) ? "None" : $CustData['CUST_DATA_NOTE'])."</p>");
			printf("</div>");
			printf("</div>");

			printf("</div>");

			//Input Block
			printf("<div>");
			printf("<input type='hidden' name='CustIndex' value=".$CustData['CUST_ID'].">");
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
	ProQueryFunctionCallback($DBConn, "HTMLCustomerOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/CustomerAddParser.php");
				require_once("Struct/Module/Form/AddForm/AddCustomerForm.php");

				ProQueryFunctionCallback($DBConn, "ProAddCustomer", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
				ProQueryFunctionCallback($DBConn, "HTMLCustomerAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");

			break;
		}
		case 1:
		{
			require_once("Struct/Module/Form/EditForm/EditCustomerForm.php");
			
			ProQueryFunctionCallback($DBConn, "HTMLCustomerEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
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
