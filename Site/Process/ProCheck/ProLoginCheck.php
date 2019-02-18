<?php
require("../../Data/ConnData/DBSessionToken.php");

session_start();

require_once("../../../MedaLib/Class/Log/LogSystem.php");
require_once("../../Data/GlobalData.php");
require_once("../../../MedaLib/Function/Filter/SecurityFilter/SecurityFilter.php");
require_once("../../Process/ProErrorLog/ProCallbackErrorLog.php");

function LoginCheck()
{
	if(isset($_POST['Email'], $_POST['Pass']) &&
	$_POST['Email'] && $_POST['Pass'])
	{
		require_once("../../../MedaLib/Class/Manager/DBConnManager.php");
		require_once("../../../MedaLib/Function/Filter/SecurityFilter/SecurityFormFilter.php");
		require_once("../../Output/Retriever/EmployeeRetriever.php");

		$sEmail = $_POST['Email'];
		$sPass = $_POST['Pass'];

		ME_SecDataFilter($Email);
		ME_SecDataFilter($Pass);

		$aEmpRows = EmployeeLoginRetriever($sEmail, $_ENV['Available']['Show']);

		if(empty($aEmpRows))
			throw new Exception("Couldn't find user, result turned empty");
		else
		{

			foreach($aEmpRows as $EmpRow => $EmpData)
			{
				if(password_verify($Pass, $EmpData['EMP_DATA_PASS']))
				{
					$_SESSION['Username'] = $EmpData['EMP_DATA_NAME'] . " " . $EmpData['EMP_DATA_SURNAME'];
					$_SESSION['AccessID'] = $EmpData['EMP_ACCESS'];
					$_SESSION['UserID'] = $EmpData['EMP_ID'];
					$_SESSION['LogedIn'] = TRUE;
				}
				else
				{
					throw new Exception("Wrong password, request access user id: " . $EmpData['EMP_ID']);
				}
			}

			header("Location:Index.php");
		}
	}
}

ProFunctionCallback("LoginCheck", $_ENV['AccessLevel']['Guest'], "POST", "../../Logs");
?>
