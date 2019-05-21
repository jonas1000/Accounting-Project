<?php
//-------------<FUNCTION>-------------//
function ProDelEmployeePosition(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['EmpPosIndex']))
	{
		if(!empty($_POST['EmpPosIndex']))
		{
			if(is_numeric($_POST['EmpPosIndex']))
			{
				//variables consindered to be holding ID
				$iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];

				unset($_POST['EmpPosIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iEmployeePositionIndex > 0) && ($IniUserAccessLevel > 0))
					EmployeePositionVisParser($InDBConn, $iEmployeePositionIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iEmployeePositionIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['EmployeePosition']);
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