<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLJobPITTransOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['JobIndex']))
	{
		if(!empty($_POST['JobIndex']))
		{
			if(is_numeric($_POST['JobIndex']))
			{
				$iJobIndex = (int) $_POST['JobIndex'];

				unset($sJobIndex);

				JobPITRetriever($InDBConn, $iJobIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

				foreach($InDBConn->GetResult() as $JobPitRow => $JobPitData)
				{
					if(((int) $JobPitData['JOB_PIT_ACCESS']) > ($IniUserAccessLevel - 1))
					{
						print("<div class='DataBlock'>");

						print("<form method='POST'>");
						print("<div>");

						//Title
						print("<div>");
						print("<h5>Transaction</h5>");
						print("</div>");

						//Data Row
						print("<div>");
						print("<div>");
						print("<b><p>Payment</p></b>");
						print("</div>");

						print("<div style='color:rgba(0,150,0,1)'>");
						printf("<p>+%s</p>", $JobPitData['JOB_PIT_PAYMENT']);
						print("</div>");
						print("</div>");

						//Data Row
						print("<div>");
						print("<div>");
						print("<b><p>Date</p></b>");
						print("</div>");

						print("<div>");
						printf("<p>%s</p>", $JobPitData['JOB_PIT_DATE']);
						print("</div>");
						print("</div>");

						print("</div>");

						print("<div>");
						printf("<input type='hidden' name='JobPITIndex' value='%s'>", $JobPitData['JOB_PIT_ID']);
						printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%s&Module=%s&SubModule=2'>", $_GET['MenuIndex'], $_GET['Module']);
						printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%s&Module=%s&SubModule=1'>", $_GET['MenuIndex'], $_GET['Module']);
						print("</div>");

						print("</form>");

						print("</div>");
					}
				}

				print("<form method='POST'>");
				printf("<input type='hidden' name='JobIndex' value='%s' required>", $_POST['JobIndex']);
				printf("<b><input class='Input-Left' type='submit' value='Add' formaction='.?MenuIndex=%s&Module=%s&SubModule=0'></b>", $_GET['MenuIndex'], $_GET['Module']);
				print("</form>");

				printf("<a href='.?MenuIndex=%s'><div class='Button-Left-ClearB'><h5>Back</h5></div></a>", $_GET['MenuIndex']);
			}
		}
	}
}

function HTMLJobOverview(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	$iUserAccessLevel = ($IniUserAccessLevel - 1);

	JobOverviewRetriever($InDBConn, $IniUserAccessLevel, $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $JobRow => $JobData)
	{
		if(((int) $JobData['JOB_DATA_ACCESS']) > $iUserAccessLevel)
		{
			$iJobIndex = (int) $JobData['JOB_ID'];

			$bIsJobIncOutSameAccessLevel = (BOOL) $JobRow['JOB_INC_ACCESS'] == $JobRow['JOB_OUT_ACCESS'];

			print("<div class='DataBlock'>");

			print("<form method='POST'>");
			print("<div>");

			//Title
			print("<div>");
			printf("<h5>%s</h5>", $JobData['JOB_DATA_TITLE']);
			print("</div>");

			if(((int) $JobData['COMP_DATA_ACCESS']) > $iUserAccessLevel)
			{
				//Data Row
				print("<div>");
				print("<div>");
				print("<b><p>Company</p></b>");
				print("</div>");

				print("<div>");
				printf("<p>%s</p>", $JobData['COMP_DATA_TITLE']);
				print("</div>");
				print("</div>");
			}

			//Data Row
			print("<div>");
			print("<div>");
			print("<b><p>Job Date</p></b>");
			print("</div>");

			print("<div>");
			printf("<p>%s</p>", $JobData['JOB_DATA_DATE']);
			print("</div>");
			print("</div>");

			if(((int)($JobData['JOB_INC_ACCESS'])) > $iUserAccessLevel)
			{
				//Data Row
				print("<div>");
				print("<div>");
				print("<b><p>Price</p></b>");
				print("</div>");

				print("<div>");
				printf("<p>%s</p>", $JobData['JOB_INC_PRICE']);
				print("</div>");
				print("</div>");

				//Data Row
				print("<div>");
				print("<div>");
				print("<b><p>Payment in advance</p></b>");
				print("</div>");

				print("<div style='color:rgba(0,150,0,1)'>");
				printf("<p>+%s</p>", $JobData['JOB_INC_PIA']);
				print("</div>");
				print("</div>");
			}

			if(((int) $JobData['JOB_OUT_ACCESS']) > $iUserAccessLevel)
			{
				//Data Row
				print("<div>");
				print("<div>");
				print("<b><p>Expences</p></b>");
				print("</div>");

				print("<div style='color:rgba(230,0,0,1)'>");
				printf("<p>%s</p>", $JobData['JOB_OUT_EXPENSES']);
				print("</div>");
				print("</div>");

				//Data Row
				print("<div>");
				print("<div>");
				print("<b><p>Damage</p></b>");
				print("</div>");

				print("<div style='color:rgba(230,0,0,1)'>");
				printf("<p>%s</p>", $JobData['JOB_OUT_DAMAGE']);
				print("</div>");
				print("</div>");
			}

			$DBConn = new ME_CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix'], $_SESSION['ConnEncoding']);

			JobPITByJobIDSpecificRetriever($DBConn, $iJobIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

			$aJobPITRow = $DBConn->GetResultArray(MYSQLI_ASSOC);
			$iJobPitNumRows = $DBConn->GetResultNumRows();

			if(!empty($aJobPITRow) && ($iJobPitNumRows > 0 && $iJobPitNumRows < 2))
			{
				$iJobPITSum = (float) $aJobPITRow['JOB_PIT_SUM'];

				if(($iJobIndex > 0))
				{
					if(($bIsJobIncOutSameAccessLevel) && ( $JobData['JOB_INC_ACCESS'] > $iUserAccessLevel || $JobData['JOB_OUT_ACCESS'] > $iUserAccessLevel))
					{
						$JobSum = (float)($iJobPITSum + ((float) $JobData['JOB_INC_PIA']) + (-abs((float)$JobData['JOB_OUT_EXPENSES']) - abs((float)$JobData['JOB_OUT_DAMAGE'])));

						//Data Row
						print("<div>");
						print("<div>");
						print("<b><p>Sumary</p></b>");
						print("</div>");

						if($JobSum < 0)
						{
							print("<div style='color:rgba(230,0,0,1)'>");
							printf("<p>%1.2f</p>", $JobSum);
							print("</div>");
						}
						else
						{
							print("<div style='color:rgba(0,230,0,1)'>");
							printf("<p>+%1.2f</p>", $JobSum);
							print("</div>");
						}

						print("</div>");

						unset($JobSum);
					}
				}

				unset($iJobPITSum);
			}
			else
			{
				if(($bIsJobIncOutSameAccessLevel) && ( $JobData['JOB_INC_ACCESS'] > $iUserAccessLevel || $JobData['JOB_OUT_ACCESS'] > $iUserAccessLevel))
					{
						$JobSum = (float) (((float) $JobData['JOB_INC_PIA']) + (-abs((float)$JobData['JOB_OUT_EXPENSES']) - abs((float)$JobData['JOB_OUT_DAMAGE'])));

						//Data Row
						print("<div>");
						print("<div>");
						print("<b><p>Sumary</p></b>");
						print("</div>");

						if($JobSum < 0)
						{
							print("<div style='color:rgba(230,0,0,1)'>");
							printf("<p>%1.2f</p>", $JobSum);
							print("</div>");
						}
						else
						{
							print("<div style='color:rgba(0,230,0,1)'>");
							printf("<p>+%1.2f</p>", $JobSum);
							print("</div>");
						}

						print("</div>");

						unset($JobSum);
					}
			}

			unset($DBConn, $aJobRow, $iJobPitNumRows);
		
			print("</div>");

			print("<div>");
			printf("<input type='hidden' name='JobIndex' value='%s'>", $JobData['JOB_ID']);
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=%s&Module=2'>", $_GET['MenuIndex']);

			if(($bIsJobIncOutSameAccessLevel) && ( $JobData['JOB_INC_ACCESS'] > $iUserAccessLevel || $JobData['JOB_OUT_ACCESS'] > $iUserAccessLevel))
				printf("<input id='JobPIT' type='submit' value='Payments' formaction='.?MenuIndex=%s&Module=3'>", $_GET['MenuIndex']);

			printf("<input type='submit' value='Edit' formaction='.?MenuIndex=%s&Module=1'>", $_GET['MenuIndex']);
			print("</div>");

			print("</form>");

			print("</div>");

			unset($bIsJobIncOutSameAccessLevel);
		}
	}

	printf("<a href='.?MenuIndex=%s&Module=0'><div class='Button-Left'><h5>Add</h5></div></a>", $_GET['MenuIndex']);

	unset($iUserAccessLevel);
}

//-------------<PHP-HTML>-------------//
if(!isset($_GET['Module']))
{
	require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
	require_once("Output/Retriever/JobRetriever.php");

	ProQueryFunctionCallback($DBConn, "HTMLJobOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
}
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['ProAdd']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/AddParser/JobAddParser.php");
				require_once("Process/ProAdd/ProAddJob.php");

				ProQueryFunctionCallback($DBConn, "ProAddJob", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/Retriever/CompanyRetriever.php");
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/AddForm/JobAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLJobAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}

			break;
		}
		case 1:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

			if(isset($_GET['ProEdit']))
			{
				require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
				require_once("Input/Parser/EditParser/JobEditParser.php");
				require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
				require_once("Output/Retriever/JobRetriever.php");
				require_once("Process/ProEdit/ProEditJob.php");

				ProQueryFunctionCallback($DBConn, "ProEditJob", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Output/Retriever/AccessRetriever.php");
				require_once("Output/Retriever/CompanyRetriever.php");
				require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
				require_once("Struct/Element/Function/Select/SelectCompanyRowRender.php");
				require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
				require_once("Struct/Module/Form/EditForm/JobEditForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLJobEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}

			break;
		}
		case 2:
		{
			require_once("Input/Parser/VisibilityParser/JobVisParser.php");
			require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
			require_once("Process/ProDel/ProDelJob.php");

			ProQueryFunctionCallback($DBConn, "ProDelJob", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

			break;
		}
		case 3:
		{
			if(!isset($_GET['SubModule']))
			{
				require_once("Output/Retriever/JobRetriever.php");

				ProQueryFunctionCallback($DBConn, "HTMLJobPITTransOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
				switch($_GET['SubModule'])
				{
					case 0:
					{
						require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

						if(isset($_GET['ProAdd']))
						{
							require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
							require_once("Input/Parser/AddParser/JobPitAddParser.php");
							require_once("Process/ProAdd/ProAddJobPIT.php");

							ProQueryFunctionCallback($DBConn, "ProAddJobPit", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
						}
						else
						{
							require_once("Output/Retriever/JobRetriever.php");
							require_once("Output/Retriever/AccessRetriever.php");
							require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
							require_once("Struct/Module/Form/AddForm/JobPITAddForm.php");

							ProQueryFunctionCallback($DBConn, "HTMLJobPitAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
						}

						break;
					}

					case 1:
					{
						require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

						if(isset($_GET['ProEdit']))
						{
							require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataNumericType.php");
							require_once("Input/Parser/EditParser/JobPITEditParser.php");
							require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
							require_once("Process/ProEdit/ProEditJobPIT.php");

							ProQueryFunctionCallback($DBConn, "ProEditJobPIT", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
						}
						else
						{
							require_once("Output/SpecificRetriever/JobSpecificRetriever.php");
							require_once("Output/Retriever/AccessRetriever.php");
							require_once("Struct/Element/Function/Select/SelectAccessRowRender.php");
							require_once("Struct/Module/Form/EditForm/JobPITEditForm.php");

							ProQueryFunctionCallback($DBConn, "HTMLJobPITEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
						}

						break;
					}

					case 2:
					{
						require_once("Input/Parser/VisibilityParser/JobPITVisParser.php");
						require_once("Process/ProDel/ProDelJobPIT.php");

						ProQueryFunctionCallback($DBConn, "ProDelJobPIT", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

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

unset($DBConn);
?>
