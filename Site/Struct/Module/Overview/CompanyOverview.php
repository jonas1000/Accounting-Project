<?php
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCompanyOverview(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/CompanyRetriever.php");

	CompanyOverviewRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CompRow => $CompData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			//Data div block
			printf("<div>");

			printf("<div>");
			printf("<h5>".$CompData['COMP_DATA_TITLE']."</h5>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Creation Date</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$CompData['COMP_DATA_DATE']."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Country</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$CompData['COUN_DATA_TITLE']."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>County</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$CompData['COU_DATA_TITLE']."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Tax</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$CompData['COU_DATA_TAX']."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Interest Rate</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$CompData['COU_DATA_IR']."</p>");
			printf("</div>");
			printf("</div>");

			printf("</div>");

			//Input Block
			printf("<div>");
			printf("<input type='hidden' name='CompIndex' value=".$CompData['COMP_ID'].">");
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
	ProQueryFunctionCallback($DBConn, "HTMLCompanyOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/CompanyAddParser.php");
				require_once("Process/ProAdd/ProAddCompany.php");

				ProQueryFunctionCallback($DBConn, "ProAddCompany", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/CompanyAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLCompanyAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}
			break;
		}
		case 1:
		{	
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/EditParser/CompanyEditParser.php");
			require_once("Struct/Module/Form/EditForm/CompanyEditForm.php");

			ProQueryFunctionCallback($DBConn, "HTMLCompanyEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/CompanyVisParser.php");
			require_once("Process/ProDel/ProDelCompany.php");
			
			ProQueryFunctionCallback($DBConn, "ProDelCompany", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
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
