<?php
function EmployeePositionEditParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, string &$InsName, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsName))
	{
		if(($IniEmployeePositionIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();
			
			$sDBQuery = "UPDATE
			".$sPrefix."VIEW_EMPLOYEE_POSITION_EDIT
			SET
			".$sPrefix."VIEW_EMPLOYEE_POSITION_EDIT.EMP_POS_TITLE = \"".$InsName."\",
			".$sPrefix."VIEW_EMPLOYEE_POSITION_EDIT.EMP_POS_ACCESS_ID = ".$IniContentAccessLevelIndex."
			WHERE
			(".$sPrefix."VIEW_EMPLOYEE_POSITION_EDIT.EMP_POS_AVAIL_ID = ".$IniIsAvailIndex.")
			AND
			(".$sPrefix."VIEW_EMPLOYEE_POSITION_EDIT.EMP_POS_ID = ".$IniEmployeePositionIndex.");";

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
	else
		throw new Exception("Input parameters are empty");
}
?>