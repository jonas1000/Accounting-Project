<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLCountyOverview(CDBConnManager &$InDBConn) : void
{
	require_once("Output/Retriever/CountyRetriever.php");

	CountyGeneralRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CouRow => $CouData)
	{
		printf("<div class='DataBlock'>");

		printf("<form method='POST'>");

		//Data div block
		printf("<div>");

		printf("<div>");
		printf("<h5>".$CouData['COU_DATA_TITLE']."</h5>");
		printf("</div>");

		//Data Row
		printf("<div>");
		printf("<div>");
		printf("<b><p>Tax</p></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$CouData['COU_DATA_TAX']."</p>");
		printf("</div>");
		printf("</div>");

		//Data Row
		printf("<div>");
		printf("<div>");
		printf("<b><p>Interest Rate</p></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$CouData['COU_DATA_IR']."</p>");
		printf("</div>");
		printf("</div>");

		//Data Row
		printf("<div>");
		printf("<div>");
		printf("<b><p>Date</p></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$CouData['COU_DATA_DATE']."</p>");
		printf("</div>");
		printf("</div>");

		printf("</div>");

		//Input Block
		printf("<div>");
		printf("<input type='hidden' name='CouIndex' value=".$CouData['COU_ID'].">");
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
	ProQueryFunctionCallback($DBConn, "HTMLCountyOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/CountyAddParser.php");
				require_once("Process/ProAdd/ProAddCounty.php");

				ProQueryFunctionCallback($DBConn, "ProAddCounty", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/CountyAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLCountyAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}

			break;
		}
		case 1:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/EditParser/CountyEditParser.php");
			require_once("Struct/Module/Form/EditForm/CountyEditForm.php");

			ProQueryFunctionCallback($DBConn, "HTMLCountyEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/CountyVisParser.php");
			require_once("Process/ProDel/ProDelCounty.php");

			ProQueryFunctionCallback($DBConn, "ProDelCounty", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
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