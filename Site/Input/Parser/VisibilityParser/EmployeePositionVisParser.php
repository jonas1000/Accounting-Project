<?php
function EmployeePositionVisParser(CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniEmployeePositionIndex, $IniIsAvailIndex))
	{
		if(($IniEmployeePositionIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
			SET
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = " . $IniIsAvailIndex . "
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION.EMP_POS_ID = " . $IniEmployeePositionIndex . ";";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception("warning: " . $InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($sDBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>
