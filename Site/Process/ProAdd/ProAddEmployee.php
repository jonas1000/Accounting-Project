<?php
//-------------<FUNCTION>-------------//
function ProAddEmployee(ME_CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Surname'], $_POST['Pass'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Access'], $_POST['Company'], $_POST['EmployeePosition']))
	{
	 	if(!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Surname'], $_POST['Pass'], $_POST['Email'], $_POST['BDay'], $_POST['PN'], $_POST['Access'], $_POST['Company'], $_POST['EmployeePosition']))
		{
			if(ME_MultyCheckNumericType($_POST['Access'], $_POST['Company'], $_POST['EmployeePosition']))
			{
				//take strings as is
				$sName = $_POST['Name'];
				$sSurname = $_POST['Surname'];
				$sPassword = $_POST['Pass'];
				$sEmail = $_POST['Email'];
				$sBDay = $_POST['BDay'];
				$sPhoneNumber = $_POST['PN'];
				$sStableNumber = $_POST['SN'];

				//Convert data to float for logical methematical operations
				$fSalary = (float) $_POST['Salary'];

				//variables consindered to be holding ID's
				$iContentAccessIndex = (int) $_POST['Access'];
				$iCompanyIndex = (int) $_POST['Company'];
				$iEmployeePositionIndex = (int) $_POST['EmployeePosition'];

				unset($_POST['Name'], $_POST['Surname'], $_POST['Password'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sName);
				ME_SecDataFilter($sSurname);
				ME_SecDataFilter($sPassword);
				ME_SecDataFilter($sEmail);
				ME_SecDataFilter($sBDay);
				ME_SecDataFilter($sPhoneNumber);
				ME_SecDataFilter($sStableNumber);

				//Limit data to a certain acceptable range
				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($fSalary > -1) && ($iContentAccessIndex > 0) && ($iCompanyIndex > 0) && ($iEmployeePositionIndex > 0))
				{
					EmployeeDataAddParser($InDBConn, $sName, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccessIndex, $_ENV['Available']['Show']);

					//check if last id could be aquired
					if($InDBConn->GetLastQueryID())
						EmployeeAddParser($InDBConn, $iEmployeePositionIndex, $iCompanyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("couldn't get last id of query");
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");
					
				unset($sTitle, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccessIndex, $iEmployeePositionIndex, $iCompanyIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Employee']);
			}
			else 
                throw new Exception("Some POST variables are not considered numeric type");
		}
		else
			throw new Exception("Some POST variables are empty, Those POST variables cannot be empty");
	}
	else
		throw new Exception("Missing POST variables to complete transaction");
}
?>
