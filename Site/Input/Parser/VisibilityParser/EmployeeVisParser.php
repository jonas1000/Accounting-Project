<?php
function EmployeeVisParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex)
{
	if(($IniEmployeeIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE
		SET
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE.EMP_AVAIL = ".$IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_EMPLOYEE.EMP_ID = ".$IniEmployeeIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_EMPLOYEE.EMP_ACCESS > ".($IniUserAccessLevelIndex - 1).");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}
?>
