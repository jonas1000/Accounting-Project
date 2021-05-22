<?php

function ProLogin(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
    if(isset($_POST['Email'], $_POST['Pass']))
    {
        $sEmail = ME_SecDataFilter($_POST['Email']);
        $sPass = ME_SecDataFilter($_POST['Pass']);

        $rResult = EmployeeLoginRetriever($InrConn, $InrLogHandle, $sEmail, $GLOBALS['AVAILABLE']['SHOW']);

        if(!empty($rResult) && $rResult->num_rows == 1)
        {
            $aDataRow = $rResult->fetch_assoc();

            if(password_verify($sPass, $aDataRow['EMP_DATA_PASS']))
            {  
                $_SESSION['UserName'] = $aDataRow['EMP_DATA_NAME'] . " " . $aDataRow['EMP_DATA_SURNAME'];
                $_SESSION['AccessID'] = $aDataRow['EMP_ACCESS'];
                $_SESSION['UserID'] = $aDataRow['EMP_ID'];
                $_SESSION['Login'] = TRUE;
            }
            else
                $InrLogHandle->AddLogMessage("Password was not correct!", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("Result was empty", __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("Paramaters are missing for logging", __FILE__, __FUNCTION__, __LINE__);
}

function ProLogout(ME_CLogHandle &$InrLogHandle)
{
    if($_SESSION['Login'])
        session_unset();
    else
        $InrLogHandle->AddLogMessage("Request denied, User is not loged in", __FILE__, __FUNCTION__, __LINE__);
}

?>