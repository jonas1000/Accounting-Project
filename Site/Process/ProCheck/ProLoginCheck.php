<?php
function LoginCheck(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle)
{
    if(isset($_POST['Email'], $_POST['Pass']) && !ME_MultyCheckEmptyType($_POST['Email'], $_POST['Pass'])) 
    {
        //format the string to be compatible with HTML and avoid SQL injection
        $sEmail = ME_SecDataFilter($_POST['Email']);
        $sPass = ME_SecDataFilter($_POST['Pass']); 

        $rResult = EmployeeLoginRetriever($InrConn, $InrLogHandle, $sEmail, $GLOBALS['AVAILABLE']['Show']);

        if(!empty($rResult) && ($rResult->num_rows == 1))
        {
            $aDataRow = $rResult->fetch_assoc();

            if(password_verify($sPass, $aDataRow['EMP_DATA_PASS'])) 
            {
                $_SESSION['Username'] = $aDataRow['EMP_DATA_NAME'] . " " . $aDataRow['EMP_DATA_SURNAME'];
                $_SESSION['AccessID'] = $aDataRow['EMP_ACCESS'];
                $_SESSION['UserID'] = $aDataRow["EMP_ID"];
                $_SESSION['LogedIn'] = TRUE;
            } 
            else                    
                $InrLogHandle->AddLogMessage("Wrong password, requested access user id: " . $aDataRow['EMP_ID'], __FILE__, __FUNCTION__, __LINE__);

            $rResult->free();
        }
        else
            $InrLogHandle->AddLogMessage("Could not find user with email: " . $sEmail, __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Some POST data are not initialized",__FILE__, __FUNCTION__, __LINE__);
}
?>