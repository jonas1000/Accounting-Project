<?php
function ProEditJob(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['JobIndex'], $_POST['Name'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Date'], $_POST['Company'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['JobIndex'], $_POST['Name'], $_POST['Date'], $_POST['Company'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['JobIndex'], $_POST['Company'], $_POST['Access']))
            {
                $sName = $_POST['Name'];
                $sDate = $_POST['Date'];

                $fPrice = (float) $_POST['Price'];
                $fPIA = (float) $_POST['PIA'];
                $fExpenses = (float) $_POST['Expenses'];
                $fDamage = (float) $_POST['Damage'];

                $iJobIndex = (int) $_POST['JobIndex'];
                $iCompanyIndex = (int) $_POST['Company'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['JobIndex'], $_POST['Name'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Date'], $_POST['Company'], $_POST['Access']);

                ME_SecDataFilter($sName);
                ME_SecDataFilter($sDate);

                if(($iJobIndex > 0) && ($iCompanyIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    JobSpecificRetriever($InDBConn, $iJobIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aJobRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iJobNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aJobRow) && ($iJobNumRows > 0 && $iJobNumRows < 2))
                    {
                        $iJobDataIndex = (int) $aJobRow['JOB_DATA_ID'];
                        $iJobIncomeIndex = (int) $aJobRow['JOB_INC_ID'];
                        $iJobOutcomeIndex = (int) $aJobRow['JOB_OUT_ID'];
                        $iJobAccessLevel = (int) $aJobRow['JOB_ACCESS'];

                        if(($iJobDataIndex > 0) && ($iJobIncomeIndex > 0) && ($iJobOutcomeIndex > 0) && ($iJobAccessLevel > 0))
                        {
                            if($iJobAccessLevel > ($iJobAccessLevel - 1))
                            {
                                JobEditParser($InDBConn, $iJobIndex, $iCompanyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);

                                JobDataEditParser($InDBConn, $iJobDataIndex, $sName, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);

                                JobIncomeEditParser($InDBConn, $iJobIncomeIndex, $fPrice, $fPIA, $iContentAccessIndex, $_ENV['Available']['Show']);

                                JobOutcomeEditParser($InDBConn, $iJobOutcomeIndex, $fExpenses, $fDamage, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
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

                unset($sName, $sDate, $fPrice, $fPIA, $fExpenses, $fDamage, $iJobIndex, $iCompanyIndex, $iContentAccessIndex);
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