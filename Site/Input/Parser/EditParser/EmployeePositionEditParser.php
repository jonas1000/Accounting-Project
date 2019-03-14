<?php
function EmployeePositionEditParser(ME_CDBConnManager &$InDBConn, int &$IniEmployeePositionIndex, string &$InsName, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsName))
	{
		if(($IniEmployeePositionIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();
			
			$sDBQuery = "UPDATE
            ".$sPrefix."VIEW_EMPLOYEE_POSITION
            SET
            ".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_Title = \"".$InsName."\",
            ".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS = ".$IniContentAccessLevelIndex."
            WHERE
			(".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ID = ".$IniEmployeePositionIndex."
			AND
			".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_ACCESS > ".($IniUserAccessLevelIndex - 1)."
			AND
			".$sPrefix."VIEW_EMPLOYEE_POSITION.EMP_POS_AVAIL = ".$IniIsAvailIndex.");";

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