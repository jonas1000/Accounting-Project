<?php
function ProEditJobPIT(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['JobPITIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['JobPITIndex'], $_POST['Date'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['JobPITIndex'], $_POST['PIT'], $_POST['Access']))
            {
                $sDate = $_POST['Date'];

                $fPIT = (float) $_POST['PIT'];

                $iJobPITIndex = (int) $_POST['JobPITIndex'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset( $_POST['JobPITIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']);

                ME_SecDataFilter($sDate);

                if(($iJobPITIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    JobPITSpecificRetriever($InDBConn, $iJobPITIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aJobPITRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iJobPitNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aJobPITRow) && ($iJobPitNumRows > 0 && $iJobPitNumRows < 2))
                    {
                        $iJobPITAccessLevel = (int) $aJobPITRow['JOB_PIT_ACCESS'];

                        if($iJobPITAccessLevel > 0)
                        {
                            if($iJobPITAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                JobPITEditParser($InDBConn, $iJobPITIndex, $fPIT, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iJobPITAccessLevel);
                    }
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aJobPITRow, $iJobPitNumRows);
                }
                else
                    throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                unset($sDate, $fPIT, $iJobPITIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Job']);
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