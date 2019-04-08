<?php
//-------------<FUNCTION>-------------//
function ProDelJob(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['JobIndex']))
	{
		if(!empty($_POST['JobIndex']))
		{
			if(is_numeric($_POST['JobIndex']))
			{
				//variables consindered to be holding ID
				$iJobIndex = (int) $_POST['JobIndex'];

				unset($_POST['JobIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iJobIndex > 0) && ($IniUserAccessLevel > 0))
				{
					JobSpecificRetriever($InDBConn, $iJobIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

					$aJobRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
					$iJobNumRows = $InDBConn->GetResultNumRows();

					if(!empty($aJobRow) && ($iJobNumRows > 0 && $iJobNumRows < 2))
					{
						$iJobDataIndex = (int) $aJobRow['JOB_DATA_ID'];
						$iJobIncomeIndex = (int) $aJobRow['JOB_INC_ID'];
						$iJobOutcomeIndex = (int) $aJobRow['JOB_OUT_ID'];

						if(($iJobDataIndex > 0) && ($iJobIncomeIndex > 0) && ($iJobOutcomeIndex > 0))
						{
							JobVisParser($InDBConn, $iJobIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							JobDataVisParser($InDBConn, $iJobDataIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							JobIncomeVisParser($InDBConn, $iJobIncomeIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							JobOutcomeVisParser($InDBConn, $iJobOutcomeIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
						}
						else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

						unset($iJobDataIndex, $iJobIncomeIndex, $iJobOutcomeIndex);
					}
					else
						throw new Exception("Could not fetch Table result");

					unset($aJobRow, $iJobNumRows);
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iJobIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Job']);
			}
			else 
                throw new Exception("Some POST variables are not considered numeric type");
		}
		else
			throw new Exception("Some POST variables are empty, Those POST variables cannot be empty");
	}
	else
		throw new Exception("Missing POST variables to complete transaction");
}
?>