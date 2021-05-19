<?php
function ProEditJob(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
    if(isset($_POST['JobIndex'], $_POST['Name'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Date'], $_POST['Company'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['JobIndex'], $_POST['Name'], $_POST['Date'], $_POST['Company'], $_POST['Access']) 
    && ME_MultyCheckNumericType($_POST['JobIndex'], $_POST['Company'], $_POST['Access'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage']))
    {
        $sName = ME_SecDataFilter($_POST['Name']);
        $sDate = ME_SecDataFilter($_POST['Date']);

        $fPrice = abs((float)$_POST['Price']);
        $fPIA = abs((float)$_POST['PIA']);
        $fExpenses = -abs((float)$_POST['Expenses']);
        $fDamage = -abs((float)$_POST['Damage']);

        $iJobIndex = (int)$_POST['JobIndex'];
        $iCompanyIndex = (int)$_POST['Company'];
        $iContentAccess = (int)$_POST['Access'];

        if(($fPrice >= 0.0) &&
        ($fPIA >= 0.0) &&
        ($fExpenses <= 0.0) &&
        ($fDamage <= 0.0) &&
        ($iJobIndex > 0) &&
        ($iCompanyIndex > 0) &&
        CheckAccessRange($iContentAccess) &&
        CheckAccessRange($IniUserAccess))
        {
            $rResult = JobSpecificRetriever($InrConn, $InrLogHandle, $iJobIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iJobDataIndex = (int) $aDataRow['JOB_DATA_ID'];
                $iJobIncomeIndex = (int) $aDataRow['JOB_INC_ID'];
                $iJobOutcomeIndex = (int) $aDataRow['JOB_OUT_ID'];
                $iJobAccess = (int) $aDataRow['JOB_ACCESS'];

                if(($iJobDataIndex > 0) && ($iJobIncomeIndex > 0) && ($iJobOutcomeIndex > 0) && CheckAccessRange($iJobAccess))
                {
                    if(JobEditParser($InrConn, $InrLogHandle, $iJobIndex, $iCompanyIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                    {
                        if(JobDataEditParser($InrConn, $InrLogHandle, $iJobDataIndex, $sName, $sDate, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                        {
                            if(JobIncomeEditParser($InrConn, $InrLogHandle, $iJobIncomeIndex, $fPrice, $fPIA, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                            {
                                if(JobOutcomeEditParser($InrConn, $InrLogHandle, $iJobOutcomeIndex, $fExpenses, $fDamage, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                                    $InrConn->Commit();
                                else
                                {
                                    $InrConn->RollBack();
                                    $InrLogHandle->AddLogMessage("Failed to edit outcome table", __FILE__, __FUNCTION__, __LINE__);
                                }
                            }
                            else
                            {
                                $InrConn->RollBack();
                                $InrLogHandle->AddLogMessage("Failed to edit income table", __FILE__, __FUNCTION__, __LINE__);
                            }
                        }
                        else
                        {
                            $InrConn->RollBack();
                            $InrLogHandle->AddLogMessage("Failed to edit data table", __FILE__, __FUNCTION__, __LINE__);
                        }
                    }
                    else
                    {
                        $InrConn->RollBack();
                        $InrLogHandle->AddLogMessage("Failed to edit table", __FILE__, __FUNCTION__, __LINE__);
                    }
                }
                else
                    $InrLogHandle->AddLogMessage("Query returned empty, did not find any ID (Possible data corruption)", __FILE__, __FUNCTION__, __LINE__);

                $rResult->free();
            }
            else
                $InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>