<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

function HTMLCountyOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	require_once("Output/Retriever/CountyRetriever.php");

	CountyGeneralRetriever($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CouRow => $CouData)
	{
		print("<div class='DataBlock'>");

		print("<form method='POST'>");

		//Data div block
		print("<div>");

		print("<div>");
		printf("<h5>%s</h5>", $CouData['COU_DATA_TITLE']);
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Tax</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $CouData['COU_DATA_TAX']);
		print("</div>");
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Interest Rate</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $CouData['COU_DATA_IR']);
		print("</div>");
		print("</div>");

		//Data Row
		print("<div>");
		print("<div>");
		print("<b><p>Date</p></b>");
		print("</div>");

		print("<div>");
		printf("<p>%s</p>", $CouData['COU_DATA_DATE']);
		print("</div>");
		print("</div>");

		print("</div>");

		//Input Block
		print("<div>");
		printf("<input type='hidden' name='CouIndex' value='%s'>", $CouData['COU_ID']);
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
	ProQueryFunctionCallback($DBConn, "HTMLCountyOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['ProAdd']))
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

			if(isset($_GET['ProEdit']))
			{
				require_once("Input/Parser/EditParser/CountyEditParser.php");
				require_once("Output/Retriever/CountyRetriever.php");
				require_once("Process/ProEdit/ProEditCounty.php");
				
                ProQueryFunctionCallback($DBConn, "ProEditCounty", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
                require_once("Output/SpecificRetriever/CountySpecificRetriever.php");
                require_once("Output/SpecificRetriever/AccessSpecificRetriever.php");
				require_once("Struct/Module/Form/EditForm/CountyEditForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLCountyEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

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