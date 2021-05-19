<?php
function ProEditEmployee(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
    if(isset($_POST['EmployeeIndex'], $_POST['Name'], $_POST['Surname'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['EmployeeIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PN']) 
    && ME_MultyCheckNumericType($_POST['EmployeeIndex'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access'], $_POST['Salary']))
    {
        $sName = ME_SecDataFilter($_POST['Name']);
        $sSurname = ME_SecDataFilter($_POST['Surname']);
        $sEmail = ME_SecDataFilter($_POST['Email']);
        $sPhoneNumber = ME_SecDataFilter($_POST['PN']);
        $sStableNumber = ME_SecDataFilter($_POST['SN']);
        $sBDay = ME_SecDataFilter($_POST['BDay']);

        $fSalary = (float)$_POST['Salary'];

        $iEmployeeIndex = (int)$_POST['EmployeeIndex'];
        $iCompanyIndex = (int)$_POST['Company'];
        $iEmployeePositionIndex = (int)$_POST['EmployeePosition'];
        $iContentAccess = (int)$_POST['Access'];

        if(($fSalary >= 0.0) &&
        ($iEmployeeIndex > 0) &&
        ($iCompanyIndex > 0) &&
        ($iEmployeePositionIndex > 0) &&
        CheckAccessRange($iContentAccess) &&
        CheckAccessRange($IniUserAccess))
        {
            $rResult = EmployeeSpecificRetriever($InrConn, $InrLogHandle, $iEmployeeIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iEmployeeDataIndex = (int) $aDataRow['EMP_DATA_ID'];
                $iEmployeeAccess = (int) $aDataRow['EMP_ACCESS'];

                if(($iEmployeeDataIndex > 0) && CheckAccessRange($iEmployeeAccess))
                {
                    if(EmployeeEditParser($InrConn, $InrLogHandle, $iEmployeeIndex, $iEmployeePositionIndex, $iCompanyIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW'])
                    && EmployeeDataEditParser($InrConn, $InrLogHandle, $iEmployeeDataIndex, $sName, $sSurname, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                        $InrConn->Commit();
                    else
                    {
                        $InrConn->RollBack();
                        $InrLogHandle->AddLogMessage("Failed to edit tables", __FILE__, __FUNCTION__, __LINE__);
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