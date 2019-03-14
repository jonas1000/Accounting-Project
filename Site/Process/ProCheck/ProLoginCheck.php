<?php
require("Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../MedaLib/Class/Log/LogSystem.php");
require_once("Data/GlobalData.php");
require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("Process/ProErrorLog/ProCallbackErrorLog.php");

function LoginCheck(ME_CDBConnManager &$InDBConn)
{
    if (isset($_POST['Email'], $_POST['Pass'])) 
    {
        if (ME_MultyCheckEmptyType($_POST['Email'], $_POST['Pass'])) 
        {
            require_once("../MedaLib/Class/Manager/DBConnManager.php");
            require_once("../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
            require_once("Output/Retriever/EmployeeRetriever.php");

            //Users email and password
            $sEmail = $_POST['Email'];
            $sPass = $_POST['Pass'];

            //format the string to be compatible with HTML and avoid SQL injection
            ME_SecDataFilter($sEmail);
            ME_SecDataFilter($sPass);

            EmployeeLoginRetriever($InDBConn, $sEmail, $_ENV['Available']['Show']);

            $aEmpRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
			$iEmpNumRows = $InDBConn->GetResultNumRows();

			if(!empty($aEmpRow) && ($iEmpNumRows < 2 && $iEmpNumRows > 0))
			{
				if (password_verify($sPass, $aEmpRow['EMP_DATA_PASS'])) 
				{
					$_SESSION['Username'] = $aEmpRow['EMP_DATA_NAME'] . " " . $aEmpRow['EMP_DATA_SURNAME'];
					$_SESSION['AccessID'] = $aEmpRow['EMP_ACCESS'];
					$_SESSION['UserID'] = $aEmpRow['EMP_ID'];
					$_SESSION['LogedIn'] = TRUE;
				} 
				else 
					throw new Exception("Wrong password, requested access user id: " . $aEmpRow['EMP_ID']);
			}
            else
                throw new Exception("Couldn't find user, result turned empty");

            header("Location:Index.php");
        }
        else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>