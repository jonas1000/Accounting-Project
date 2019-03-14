<?php
//-------------<FUNCTION>-------------//
function ProAddEmployee(ME_CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Pass'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['Access'], $_POST['Company'], $_POST['Position']))
	{
	 	if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Pass'], $_POST['Email'], $_POST['BDay'], $_POST['Access'], $_POST['Company'], $_POST['Position']))
		{
			if(ME_MultyCheckNumericType($_POST['Salary'], $_POST['Access'], $_POST['Copmany'], $_POST['Position']))
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
				$iEmployeePosIndex = (int) $_POST['Position'];

				unset($_POST['Name'], $_POST['Surname'], $_POST['Password'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['Position'], $_POST['Access']);

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
				if(($fSalary > -1) && ($iContentAccessIndex > 0) && ($iCompanyIndex > 0) && ($iEmployeePosIndex > 0))
				{
					EmployeeDataAddParser($InDBConn, $sName, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccessIndex, $_ENV['Available']['Show']);

					//check if last id could be aquired
					if($InDBConn->GetLastQueryID())
						EmployeeAddParser($InDBConn, $iEmployeePosIndex, $iCompanyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("couldn't get last id of query");
				}
				else
					throw new Exception("Some POST data do not meet the requirement range");
					
				unset($sTitle, $sSurname, $sPassword, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccessIndex, $iEmployeePosIndex, $iCompanyIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Employee']);
			}
			else 
                throw new Exception("Some POST data are not considered numeric type");
		}
		else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
