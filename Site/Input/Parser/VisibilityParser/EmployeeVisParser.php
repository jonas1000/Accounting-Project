<?php
function EmployeeVisParser(CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniIsAvailIndex)
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniEmployeeIndex, $IniIsAvailIndex))
	{
		if(($IniEmployeeIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE
			SET
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE.EMP_AVAIL = " . $IniIsAvailIndex . "
			WHERE
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE.EMP_ID = " . $IniEmployeeIndex . ";";

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
