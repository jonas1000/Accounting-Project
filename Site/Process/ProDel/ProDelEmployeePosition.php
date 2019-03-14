<?php
//-------------<FUNCTION>-------------//
function ProDelEmployeePosition(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['EmpPosIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['EmpPosIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['EmpPosIndex']))
			{
				//variables consindered to be holding ID's
				$iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];

				unset($_POST['EmpPosIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iEmployeePositionIndex > 0)
					EmployeePositionVisParser($InDBConn, $iEmployeePositionIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iEmployeePositionIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['EmployeePosition']);
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