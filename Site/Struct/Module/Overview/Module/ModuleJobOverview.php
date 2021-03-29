<?php
$rProcessFileHandle = new ME_CFileHandle($GLOBALS['DEFAULT_LOG_FILE'], $GLOBALS['DEFAULT_LOG_PATH'], "a");

$rProcessLogHandle = new ME_CLogHandle($rProcessFileHandle, "JobProcess", __FILE__);

//This is the connection to the database using the MedaLib Folder classes.
$rConn = new ME_CDBConnManager($rProcessLogHandle, $_SESSION['DBName'], $_SESSION['ServerDNS'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//If the module is not set then CompanyOverview from menu was selected, then load the overview.
if(!isset($_GET['Module']))
{
	require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
	require_once("Output/Retriever/JobRetriever.php");

	ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLJobOverview", $GLOBALS['ACCESS']['Employee'], "GET");
}
else
{
	//Determine what module has to load from the button that was clicked.(the buttons are - Add, Edit or Delete)
    //WARNING: while add does not require a post method from the server, the Edit and Delete process require POST method to work.
	switch($_GET['Module'])
	{
		case $GLOBALS['MODULE']['Add']:
		{
			//If the form was completed from the add form then execute the process to at those data in the database.
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/AddParser/JobAddParser.php");
				require_once("Process/ProAdd/ProAddJob.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProAddJob", $GLOBALS['ACCESS']['Employee'], "POST");

				header("Location:Index.php?MenuIndex=".$GLOBALS['MENU_INDEX']['Job']);
			}
			else
			{
				require_once("Output/Retriever/CompanyRetriever.php");
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/AddForm/JobAddForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLJobAddForm", $GLOBALS['ACCESS']['Employee'], "GET");
			}

			break;
		}
		case $GLOBALS['MODULE']['Edit']:
		{
			//If the form was completed from the Edit form then execute the process and Edit those data in the database.
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/JobEditParser.php");
				require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
				require_once("Output/Retriever/JobRetriever.php");
				require_once("Process/ProEdit/ProEditJob.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProEditJob", $GLOBALS['ACCESS']['Employee'], "POST");
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/Retriever/CompanyRetriever.php");
				require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/JobEditForm.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLJobEditForm", $GLOBALS['ACCESS']['Employee'], "POST");
			}

			break;
		}
		case $GLOBALS['MODULE']['Delete']:
		{
			//Execute the process and edit the show flag data in the database.
			require_once("Input/Parser/VisibilityParser/JobVisParser.php");
			require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
			require_once("Process/ProDel/ProDelJob.php");

			ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProDelJob", $GLOBALS['ACCESS']['Employee'], "POST");

			break;
		}
		case $GLOBALS['MODULE']['Extend']:
		{
			if(!isset($_GET['SubModule']))
			{
				require_once("Output/Retriever/JobRetriever.php");

				ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLJobPITTransOverview", $GLOBALS['ACCESS']['Employee'], "POST");
			}
			else
				switch($_GET['SubModule'])
				{
					case $GLOBALS['MODULE']['Add']:
					{
						//If the form was completed from the add form then execute the process to at those data in the database.
						require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

						if(isset($_GET['ProAdd']))
						{
							require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
							require_once("Input/Parser/AddParser/JobPitAddParser.php");
							require_once("Process/ProAdd/ProAddJobPIT.php");

							ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProAddJobPit", $GLOBALS['ACCESS']['Employee'], "POST");

							header("Location:Index.php?MenuIndex=".$GLOBALS['MENU_INDEX']['Job']);
						}
						else
						{
							require_once("Output/Retriever/JobRetriever.php");
							require_once("Output/Retriever/AccessRetriever.php");
							require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
							require_once("Struct/Module/Form/AddForm/JobPITAddForm.php");

							ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLJobPitAddForm", $GLOBALS['ACCESS']['Employee'], "POST");
						}

						break;
					}

					case $GLOBALS['MODULE']['Edit']:
					{
						//If the form was completed from the Edit form then execute the process and Edit those data in the database.
						require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

						if(isset($_GET['ProEdit']))
						{
							require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
							require_once("Input/Parser/EditParser/JobPITEditParser.php");
							require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
							require_once("Process/ProEdit/ProEditJobPIT.php");

							ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProEditJobPIT", $GLOBALS['ACCESS']['Employee'], "POST");
						}
						else
						{
							require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
							require_once("Output/Retriever/AccessRetriever.php");
							require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
							require_once("Struct/Module/Form/EditForm/JobPITEditForm.php");

							ProQueryFunctionCallback($rConn, $rProcessLogHandle, "HTMLJobPITEditForm", $GLOBALS['ACCESS']['Employee'], "POST");
						}

						break;
					}

					case $GLOBALS['MODULE']['Delete']:
					{
						//Execute the process and edit the show flag data in the database.
						require_once("Input/Parser/VisibilityParser/JobPITVisParser.php");
						require_once("Process/ProDel/ProDelJobPIT.php");

						ProQueryFunctionCallback($rConn, $rProcessLogHandle, "ProDelJobPIT", $GLOBALS['ACCESS']['Employee'], "POST");

						break;
					}
				}

			break;
		}
		default:
		{
			header("Location:.");

			break;
		}
	}
}

$rProcessLogHandle->WriteToFileAndClear();
?>
