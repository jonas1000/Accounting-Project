<?php
function EmployeeVisParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeeIndex, int &$IniIsAvailIndex)
{
	if(($IniEmployeeIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_EMPLOYEE_VISIBILITY
		SET
		".$sPrefix."VIEW_EMPLOYEE_VISIBILITY.EMP_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_VISIBILITY.EMP_ID = ".$IniEmployeeIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function EmployeeDataVisParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeeDataIndex, int &$IniIsAvailIndex)
{
	if(($IniEmployeeDataIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_EMPLOYEE_DATA_VISIBILITY
		SET
		".$sPrefix."VIEW_EMPLOYEE_DATA_VISIBILITY.EMP_DATA_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_EMPLOYEE_DATA_VISIBILITY.EMP_DATA_ID = ".$IniEmployeeDataIndex.");";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}
?>
