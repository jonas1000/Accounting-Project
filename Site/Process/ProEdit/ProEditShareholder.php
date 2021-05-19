<?php
function ProEditShareholder(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
    if(isset($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']) 
    && ME_MultyCheckNumericType($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
    {
        $iShareholderIndex = (int)$_POST['ShareIndex'];
        $iEmployeeIndex = (int)$_POST['Employee'];
        $iContentAccess = (int)$_POST['Access'];

        if(($iShareholderIndex > 0) && ($iEmployeeIndex > 0) && CheckAccessRange($IniUserAccess))
        {
            $rResult = ShareholderSpecificRetriever($InrConn, $InrLogHandle, $iShareholderIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iShareholderAccess = (int)$aDataRow['SHARE_ACCESS'];

                if(CheckAccessRange($iShareholderAccess))
                {
                    if(ShareholderEditParser($InrConn, $InrLogHandle, $iShareholderIndex, $iEmployeeIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
	}
	else
        $InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>