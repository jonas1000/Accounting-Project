<?php
//-------------<FUNCTION>-------------//
function ProDelEmployee(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['EmpIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['EmpIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['EmpIndex']))
			{
				//variables consindered to be holding ID's
				$iEmployeeIndex = (int) $_POST['EmpIndex'];

				unset($_POST['EmpIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iEmployeeIndex > 0)
					EmployeeVisParser($InDBConn, $iEmployeeIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iEmployeeIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Employee']);
			}
			else 
                throw new Exception("Some POST data are not considered numeric type");
		}
		else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Missing POST data to complete transaction");
}
?>