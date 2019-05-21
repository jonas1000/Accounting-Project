<?php
//Only load scripts and libraries heir if your sure that at least 2 or more of the functions inside the scripts are always required
//This is to minimize the search and load time as well as the allocation and definition of functions and variables that are not needed for the rest of the script to work.
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

//This is the connection to the database using the MedaLib Folder classes.
$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLCompanyOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
    //The user access level
	//Always substract the access level by one to get the proper index of access level
	$iUserAccessLevel = ($IniUserAccessLevel - 1);

	//Number of division for the list the query returns
	$iNumberRowDivision = 4;

	//Array counter to do proper modulo operation for row division
	$iCounter = 0;

    CompanyOverviewRetriever($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);

    //The toolbar for the buttons (tools)
	print("<div class='ContentToolBar'>");
	printf("<a href='.?MenuIndex=%s&Module=0'><div class='Button-Left'><h5>ADD</h5></div></a>", $_GET['MenuIndex']);
	print("</div>");

	//The number of rows that the query returned
	$iCompanyNumRows = $InDBConn->GetResultNumRows();

	foreach($InDBConn->GetResult() as $CompRow => $CompData) 
	{
        if(((int) $CompData['COMP_DATA_ACCESS']) > $iUserAccessLevel)
        {
            //Do a modulo operation to divide the rows by the number of row divisions
			$iCounterModuloOperation = $iCounter % $iNumberRowDivision;

			$iCounter++;

			//Check if it is the first row, else execute every 0 of modulo result
			if(($iCounterModuloOperation < 1) && !($iCounter > 1))
				print("<div class='ContentArrayBlock'>");
			else if($iCounterModuloOperation < 1)
			{
				print("</div>");
				print("<div class='ContentArrayBlock'>");
			}

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

            if((((int) $CompData['COUN_DATA_ACCESS']) > $iUserAccessLevel))
            {
                //Data Row
                print("<div>");
                print("<div>");
                print("<b><p>Country</p></b>");
                print("</div>");

                print("<div>");
                printf("<p>%s</p>", $CompData['COUN_DATA_TITLE']);
                print("</div>");
                print("</div>");
            }

            if(((int) $CompData['COU_DATA_ACCESS']) > $iUserAccessLevel)
            {
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
            }

            print("</div>");

            //Button list for specific Data Row
            print("<div>");
            printf("<input type='hidden' name='CompIndex' value='%s'>", $CompData['COMP_ID']);
            printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%s&Module=2'>", $_GET['MenuIndex']);
            printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%s&Module=1'>", $_GET['MenuIndex']);
            print("</div>");

            print("</form>");

            print("</div>");

            //If array counter is equal to the length of the rows the query returned,
			//then that means that this is the last ContentArrayBlock and it needs to wrap it
			//to prevent the html elements to break.
			if($iCounter == $iCompanyNumRows) 
				print("</div>");
        }
    }
    
    unset($iUserAccessLevel, $iNumberRowDivision, $iCounter, $iCompanyNumRows, $iCounterModuloOperation);
}
//-------------<PHP-HTML>-------------//

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if (!isset($_GET['Module']))
{
    require_once("Output/Retriever/CompanyRetriever.php");

    ProQueryFunctionCallback($DBConn, "HTMLCompanyOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
}
else
{
    //Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch ($_GET['Module']) 
	{
		case 0:
			{
                //If the form was completed from the add form then execute the process and add those data in the database.
				if (isset($_GET['ProAdd'])) 
				{
					require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
					require_once("Input/Parser/AddParser/CompanyAddParser.php");
					require_once("Process/ProAdd/ProAddCompany.php");

					ProQueryFunctionCallback($DBConn, "ProAddCompany", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
				}
				else 
				{
                    require_once("Output/Retriever/AccessRetriever.php");
                    require_once("Output/Retriever/CountyRetriever.php");
                    require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
                    require_once("Struct/Element/Function/Select/SelectCountyRowRender.php");
					require_once("Struct/Module/Form/AddForm/CompanyAddForm.php");

					ProQueryFunctionCallback($DBConn, "HTMLCompanyAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
				}
				break;
			}
		case 1:
			{
                //If the form was completed from the Edit form then execute the process and Edit those data in the database.
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
                //Execute the process and edit the show flag data in the database.
                require_once("Input/Parser/VisibilityParser/CompanyVisParser.php");
                require_once("Output/SpecificRetriever/CompanySpecificRetriever.php");
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

unset($DBConn, $_GET['MenuIndex'], $_GET['Module'], $_GET['ProAdd'], $_GET['ProEdit']);
?>