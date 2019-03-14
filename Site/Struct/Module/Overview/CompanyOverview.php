<?php
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCompanyOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
    require_once("Output/Retriever/CompanyRetriever.php");

    CompanyOverviewRetriever($InDBConn, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $CompRow => $CompData) 
	{
        print("<div class='DataBlock'>");

        print("<form method='POST'>");
        //Data div block
        print("<div>");

        print("<div>");
        printf("<h5>%s</h5>", $CompData['COMP_DATA_TITLE']);
        print("</div>");

        //Data Row
        print("<div>");
        print("<div>");
        print("<b><p>Creation Date</p></b>");
        print("</div>");

        print("<div>");
        printf("<p>%s</p>", $CompData['COMP_DATA_DATE']);
        print("</div>");
        print("</div>");

        //Data Row
        print("<div>");
        print("<div>");
        print("<b><p>Country</p></b>");
        print("</div>");

        print("<div>");
        printf("<p>%s</p>", $CompData['COUN_DATA_TITLE']);
        print("</div>");
        print("</div>");

        //Data Row
        print("<div>");
        print("<div>");
        print("<b><p>County</p></b>");
        print("</div>");

        print("<div>");
        printf("<p>%s</p>", $CompData['COU_DATA_TITLE']);
        print("</div>");
        print("</div>");

        //Data Row
        print("<div>");
        print("<div>");
        print("<b><p>Tax</p></b>");
        print("</div>");

        print("<div>");
        printf("<p>%s</p>", $CompData['COU_DATA_TAX']);
        print("</div>");
        print("</div>");

        //Data Row
        print("<div>");
        print("<div>");
        print("<b><p>Interest Rate</p></b>");
        print("</div>");

        print("<div>");
        printf("<p>%s</p>", $CompData['COU_DATA_IR']);
        print("</div>");
        print("</div>");

        print("</div>");

        //Input Block
        print("<div>");
        printf("<input type='hidden' name='CompIndex' value='%s'>", $CompData['COMP_ID']);
        printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%s&Module=2'>", $_GET['MenuIndex']);
        printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%s&Module=1'>", $_GET['MenuIndex']);
        print("</div>");
        print("</form>");

        print("</div>");
	}
	
    printf("<a href='.?MenuIndex=%s&Module=0'><div class='Button-Left'><h5>Add</h5></div></a>", $_GET['MenuIndex']);
}
//-------------<PHP-HTML>-------------//
if (!isset($_GET['Module']))
	ProQueryFunctionCallback($DBConn, "HTMLCompanyOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
else
{
	switch ($_GET['Module']) 
	{
		case 0:
			{
				if (isset($_GET['ProAdd'])) 
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
                
				if(isset($_GET['ProEdit'])) 
				{
                    require_once("Output/SpecificRetriever/CompanySpecificRetriever.php");
					require_once("Input/Parser/EditParser/CompanyEditParser.php");
					require_once("Process/ProEdit/ProEditCompany.php");
					
					ProQueryFunctionCallback($DBConn, "ProEditCompany", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
				} 
				else 
				{
                    require_once("Output/SpecificRetriever/CompanySpecificRetriever.php");
                    require_once("Output/Retriever/CountyRetriever.php");
                    require_once("Output/Retriever/AccessRetriever.php");
                    require_once("Struct/Element/Function/Select/SelectCountyRowRender.php");
                    require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
					require_once("Struct/Module/Form/EditForm/CompanyEditForm.php");

					ProQueryFunctionCallback($DBConn, "HTMLCompanyEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
                }
                
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
}
unset($DBConn);
?>