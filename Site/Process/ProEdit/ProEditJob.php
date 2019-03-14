<?php
function ProEditJob(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['JobIndex'], $_POST['Name'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Date'], $_POST['Company'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['JobIndex'], $_POST['Name'], $_POST['Date'], $_POST['Company'], $_POST['Access'], $IniUserAccessLevelIndex))
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

                if(($iJobIndex > 0) && ($iCompanyIndex > 0) && ($iContentAccessIndex > 0))
                {
                    JobGeneralSpecificRetriever($InDBConn, $iJobIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                    $aJobRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iJobNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aJobRow) && ($iJobNumRows > 0 && $iJobNumRows < 2))
                    {
                        $iJobDataIndex = (int) $aJobRow['JOB_DATA_ID'];
                        $iJobIncomeIndex = (int) $aJobRow['JOB_INC_ID'];
                        $iJobOutcomeIndex = (int) $aJobRow['JOB_OUT_ID'];
                        
                        JobEditParser($InDBConn, $iJobIndex, $iCompanyIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        JobDataEditParser($InDBConn, $iJobDataIndex, $sName, $sDate, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        JobIncomeEditParser($InDBConn, $iJobIncomeIndex, $fPrice, $fPIA, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        JobOutcomeEditParser($InDBConn, $iJobOutcomeIndex, $fExpenses, $fDamage, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        unset($iJobDataIndex, $iJobIncomeIndex, $iJobOutcomeIndex);
                    }
                    else
                        throw new Exception("Could not fetch result for Company");

                    unset($aJobRow, $iJobNumRows);
                }
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sName, $sDate, $fPrice, $fPIA, $fExpenses, $fDamage, $iJobIndex, $iCompanyIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Job']);
            }
            else 
                throw new Exception("Some POST data are not considered numeric type");
        }
        else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>