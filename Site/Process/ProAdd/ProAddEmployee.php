<?php
function ProAddEmployee(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Pass'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['Access'], $_POST['Company'], $_POST['Position']))
	{
	 	if(ME_MultyCheckEmptyType($InDBConn, $_POST['Name'], $_POST['Pass'], $_POST['Email'], $_POST['BDay'], $_POST['Access'], $_POST['Company'], $_POST['Position']))
		{
			$sName = $_POST['Name'];
			$sSurname = $_POST['Surname'];
			$sPassword = $_POST['Pass'];
			$sEmail = $_POST['Email'];
			$sSalary = $_POST['Salary'];
			$sBDay = $_POST['BDay'];
			$sPhoneNumber = $_POST['PN'];
			$sStableNumber = $_POST['SN'];
			$sAccess = $_POST['Access'];
			$sCompany = $_POST['Company'];
			$sEmployeePos = $_POST['Position'];

			ME_SecDataFilter($sName);
			ME_SecDataFilter($sSurname);
			ME_SecDataFilter($sPassword);
			ME_SecDataFilter($sEmail);
			ME_SecDataFilter($sSalary);
			ME_SecDataFilter($sBDay);
			ME_SecDataFilter($sPhoneNumber);
			ME_SecDataFilter($sStableNumber);
			ME_SecDataFilter($sAccess);
			ME_SecDataFilter($sCompany);
			ME_SecDataFilter($sEmployeePos);

			$fSalary = (float) $sSalary;
			$iAccessIndex = (int) $sAccess;
			$iCompanyIndex = (int) $sCompany;
			$iEmployeePosIndex = (int) $sEmployeePos;

			unset($sSalary, $sAccess, $sCompany, $sEmployeePos);

			EmployeeDataAddParser($InDBConn, $sName, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iAccessIndex, $_ENV['Available']['Show']);

			//check if last id could be aquired
			if($InDBConn->GetLastQueryID())
				EmployeeAddParser($InDBConn, $iEmployeePosIndex, $iCompanyIndex, $iAccessIndex, $_ENV['Available']['Show']);
			else
				throw new Exception("couldn't get last id of query");

			unset($sTitle, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iAccessIndex, $iEmployeePosIndex, $iCompanyIndex);
			unset($_POST['Name'], $_POST['Surname'], $_POST['Password'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['Position'], $_POST['Access']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Employee']);
		}
		else
			throw new Exception("Some POST data are NULL, Those POST cannot be NULL");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
