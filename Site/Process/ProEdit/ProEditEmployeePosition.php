<?php
function ProEditEmployeePosition(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess)
{
    if(isset($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']) 
    && ME_MultyCheckNumericType($_POST['EmpPosIndex'], $_POST['Access']))
    {
        $sName = ME_SecDataFilter($_POST['Name']);

        $iEmployeePositionIndex = (int)$_POST['EmpPosIndex'];
        $iContentAccess = (int)$_POST['Access'];

        if(($iEmployeePositionIndex > 0) && CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
        {
            $rResult = EmployeePositionSpecificRetriever($InrConn, $InrLogHandle, $iEmployeePositionIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iEmployeePositionAccess = (int) $aDataRow['EMP_POS_ACCESS'];

                if(CheckAccessRange($iEmployeePositionAccess))
                {
                    if(EmployeePositionEditParser($InrConn, $InrLogHandle, $iEmployeePositionIndex, $sName, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
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