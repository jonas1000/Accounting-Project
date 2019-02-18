<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLShareholderOverview(CDBConnManager &$InDBConn)
{
	ShareholderGeneralRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $ShareRow => $ShareData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			printf("<div>");

			//Title
			printf("<div>");
			printf("<h5>".$ShareData['EMP_DATA_NAME']." ".$ShareData['EMP_DATA_SURNAME']."</h5>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Salary</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$ShareData['EMP_DATA_SALARY']."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Birth Date</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$ShareData['EMP_DATA_BDAY']."</p>");
			printf("</div>");
			printf("</div>");

			printf("<div>");
			printf("<div>");
			printf("<b><p>Email</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$ShareData['EMP_DATA_EMAIL']."</p>");
			printf("</div>");
			printf("</div>");

			printf("<div>");
			printf("<div>");
			printf("<b><p>Title</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$ShareData['EMP_POS_TITLE']."</p>");
			printf("</div>");
			printf("</div>");

			printf("</div>");

			printf("<div>");
			printf("<input type='hidden' name='ShareIndex' value='".$ShareData['SHARE_ID']."'>");
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
{
	require_once("Output/Retriever/ShareholderRetriever.php");

	ProQueryFunctionCallback($DBConn, "HTMLShareholderOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
}
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/ShareholderAddParser.php");
				require_once("Process/ProAdd/ProAddShareholder.php");

				ProQueryFunctionCallback($DBConn, "ProAddShareholder", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/ShareholderAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLShareholderAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}
			break;
		}
		case 1:
		{
			require_once("Struct/Module/Form/EditForm/ShareholderEditForm.php");
			
			ProQueryFunctionCallback($DBConn, "HTMLShareholderEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
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
