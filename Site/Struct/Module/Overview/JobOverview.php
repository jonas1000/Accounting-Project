<?php
require_once("../MedaLib/Class/Manager/DBConnManager.php");
require_once("../MedaLib/Function/Filter/DataFilter/MultyCheckDataTypeFilter/MultyCheckDataEmptyType.php");
require_once("../MedaLib/Class/Log/LogSystem.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

$DBConn = new CDBConnManager($_SESSION['ServerName'], $_SESSION['DBName'], $_SESSION['DBUsername'], $_SESSION['DBPassword'], $_SESSION['DBPrefix']);

//-------------<FUNCTION>-------------//
function HTMLJobPitTransOverview(CDBConnManager &$InDBConn) : void
{
	$sJobIndex = $_POST['JobIndex'];

	ME_SecDataFilter($sJobIndex);

	$iJobIndex = (int) $sJobIndex;

	unset($sJobIndex);

	JobPitRetriever($InDBConn, $iJobIndex, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $JobPitRow => $JobPitData)
	{
		printf("<div class='DataBlock'>");

		printf("<form method='POST'>");
		printf("<div>");

		//Title
		printf("<div>");
		printf("<h5>Transaction</h5>");
		printf("</div>");

		//Data Row
		printf("<div>");
		printf("<div>");
		printf("<b><p>Payment</p></b>");
		printf("</div>");

		printf("<div style='color:rgba(0,150,0,1)'>");
		printf("<p>+".$JobPitData['JOB_PIT']."</p>");
		printf("</div>");
		printf("</div>");

		//Data Row
		printf("<div>");
		printf("<div>");
		printf("<b><p>Date</p></b>");
		printf("</div>");

		printf("<div>");
		printf("<p>".$JobPitData['JOB_PIT_DATE']."</p>");
		printf("</div>");
		printf("</div>");

		printf("</div>");

		printf("<div>");
		printf("<input type='hidden' name='JobIndex' value='".$JobPitData['JOB_PIT_ID']."'>");
		printf("<input type='submit' value='Delete' formaction='.?MenuIndex=" . $_GET['MenuIndex'] . "&Module=" . $_GET['Module'] . "&SubModule=2'>");
		printf("<input type='submit' value='Edit' formaction='.?MenuIndex=" . $_GET['MenuIndex'] . "&Module=" . $_GET['Module'] . "&SubModule=1'>");
		printf("</div>");

		printf("</form>");

		printf("</div>");
	}

	printf("<form method='POST'>");
	printf("<input type='hidden' name='JobIndex' value='".$_POST['JobIndex']."' required>");
	printf("<b><input class='Input-Left' type='submit' value='Add' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=".$_GET['Module']."&SubModule=0'></b>");
	printf("</form>");

	printf("<a href='.?MenuIndex=".$_GET['MenuIndex']."'><div class='Button-Left-ClearB'><h5>Back</h5></div></a>");
}

function HTMLJobOverview(CDBConnManager &$InDBConn) : void
{
	JobOverviewRetriever($InDBConn, $_SESSION['AccessID'], $_ENV['Available']['Show']);

	foreach($InDBConn->GetResult() as $JobRow => $JobData)
	{
			printf("<div class='DataBlock'>");

			printf("<form method='POST'>");
			printf("<div>");

			//Title
			printf("<div>");
			printf("<h5>".$JobData['JOB_DATA_TITLE']."</h5>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Company</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$JobData['COMP_DATA_TITLE']."</p>");
			printf("</div>");
			printf("</div>");

			//Data Row
			printf("<div>");
			printf("<div>");
			printf("<b><p>Job Date</p></b>");
			printf("</div>");

			printf("<div>");
			printf("<p>".$JobData['JOB_DATA_DATE']."</p>");
			printf("</div>");
			printf("</div>");

			if(($_SESSION['AccessID'] - 1) < $_ENV['AccessLevel']['CEO'])
			{
				//Data Row
				printf("<div>");
				printf("<div>");
				printf("<b><p>Price</p></b>");
				printf("</div>");

				printf("<div>");
				printf("<p>".$JobData['JOB_INC_PRICE']."</p>");
				printf("</div>");
				printf("</div>");

				//Data Row
				printf("<div>");
				printf("<div>");
				printf("<b><p>Payment in advance</p></b>");
				printf("</div>");

				printf("<div style='color:rgba(0,150,0,1)'>");
				printf("<p>+".$JobData['JOB_INC_PIA']."</p>");
				printf("</div>");
				printf("</div>");

				//Data Row
				printf("<div>");
				printf("<div>");
				printf("<b><p>Expences</p></b>");
				printf("</div>");

				printf("<div style='color:rgba(230,0,0,1)'>");
				printf("<p>".$JobData['JOB_OUT_EXP']."</p>");
				printf("</div>");
				printf("</div>");

				//Data Row
				printf("<div>");
				printf("<div>");
				printf("<b><p>Damage</p></b>");
				printf("</div>");

				printf("<div style='color:rgba(230,0,0,1)'>");
				printf("<p>".$JobData['JOB_OUT_DAM']."</p>");
				printf("</div>");
				printf("</div>");

	      $JobSum = ($JobData['JOB_INC_PIA'] + ($JobData['JOB_OUT_EXP'] + $JobData['JOB_OUT_DAM']));

				//Data Row
				printf("<div>");
				printf("<div>");
				printf("<b><p>Sumary</p></b>");
				printf("</div>");

	      if($JobSum < 0)
	      {
	  			printf("<div style='color:rgba(230,0,0,1)'>");
	  			printf("<p>".$JobSum."</p>");
	  			printf("</div>");
	      }
	      else
	      {
	        printf("<div style='color:rgba(0,230,0,1)'>");
	  			printf("<p>".$JobSum."</p>");
	  			printf("</div>");
	      }

				printf("</div>");
			}
			printf("</div>");

			printf("<div>");
			printf("<input type='hidden' name='JobIndex' value='".$JobData['JOB_ID']."'>");
			printf("<input type='submit' value='Delete' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=2'>");

			if(($_SESSION['AccessID'] - 1) < $_ENV['AccessLevel']['CEO'])
				printf("<input id='JobPIT' type='submit' value='Payments' formaction='.?MenuIndex=".$_GET['MenuIndex']."&Module=3'>");

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
	require_once("Output/Retriever/JobRetriever.php");

	ProQueryFunctionCallback($DBConn, "HTMLJobOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
}
else
	switch($_GET['Module'])
	{
		case 0:
		{
			if(isset($_GET['AddPro']))
			{
				require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
				require_once("Input/Parser/AddParser/JobAddParser.php");
				require_once("Process/ProAdd/ProAddJob.php");

				ProQueryFunctionCallback($DBConn, "ProAddJob", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
			{
				require_once("Struct/Module/Form/AddForm/JobAddForm.php");

				ProQueryFunctionCallback($DBConn, "HTMLJobAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "GET", "Logs");
			}
			break;
		}
		case 1:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Struct/Module/Form/EditForm/JobEditForm.php");

			ProQueryFunctionCallback($DBConn, "HTMLJobEditForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			break;
		}
		case 2:
		{
			require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
			require_once("Input/Parser/VisibilityParser/JobVisParser.php");
			require_once("Process/ProDel/ProDelJob.php");

			ProQueryFunctionCallback($DBConn, "ProDelJob", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			break;
		}
		case 3:
		{
			if(!isset($_GET['SubModule']))
			{
				require_once("Output/Retriever/JobRetriever.php");

				ProQueryFunctionCallback($DBConn, "HTMLJobPitTransOverview", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
			}
			else
				switch($_GET['SubModule'])
				{
					case 0:
					{
						require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");

						if(isset($_GET['AddPro']))
						{
							require_once("Input/Parser/AddParser/JobPitAddParser.php");
							require_once("Process/ProAdd/ProAddJobPIT.php");

							ProQueryFunctionCallback($DBConn, "ProAddJobPit", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
						}
						else
						{
							require_once("Output/Retriever/JobRetriever.php");
							require_once("Struct/Module/Form/AddForm/JobPITAddForm.php");

							ProQueryFunctionCallback($DBConn, "HTMLJobPitAddForm", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");
						}

						break;
					}

					case 1:
					{
						ProQueryFunctionCallback($DBConn, "ProEditJobPIT", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

						break;
					}

					case 2:
					{
						require_once("Input/Parser/VisibilityParser/JobPITVisParser.php");
						require_once("Process/ProDel/ProDelJobPIT.php");

						ProQueryFunctionCallback($DBConn, "ProDelJobPit", $_SESSION['AccessID'], $_ENV['AccessLevel']['Employee'], "POST", "Logs");

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
