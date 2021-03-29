<?php
function ProEditJobPIT(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess)
{
    if(isset($_POST['JobPITIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['JobPITIndex'], $_POST['Date'], $_POST['Access'])
    && ME_MultyCheckNumericType($_POST['JobPITIndex'], $_POST['PIT'], $_POST['Access']))
    {
        $sDate = ME_SecDataFilter($_POST['Date']);

        $fPIT = (float)$_POST['PIT'];

        $iJobPITIndex = (int)$_POST['JobPITIndex'];
        $iContentAccess = (int)$_POST['Access'];

        if(($iJobPITIndex > 0) && CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
        {
            $rResult = JobPITSpecificRetriever($InrConn, $InrLogHandle, $iJobPITIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iJobPITAccess = (int) $aDataRow['JOB_PIT_ACCESS'];

                if(CheckAccessRange($iJobPITAccess))
                {
                    if(JobPITEditParser($InrConn, $InrLogHandle, $iJobPITIndex, $fPIT, $sDate, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
                        $InrConn->Commit();
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

        header("Location:.?MenuIndex=".$GLOBALS['MENU_INDEX']['Job']);
	}
	else
        $InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>