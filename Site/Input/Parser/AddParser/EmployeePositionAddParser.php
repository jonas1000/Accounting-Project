<?php
function EmployeePositionAddParser(ME_CDBConnManager &$InDBConn, string &$InsName, int $IniContentAccessLevelIndex, int $IniIsAvailIndex) : void
{
	if(!empty($InsName))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			
			$$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
			(
			EMP_POS_TITLE,
			EMP_POS_ACCESS,
			EMP_POS_AVAIL
			)
			VALUES
			(
			\"".$InsName."\",
			".$IniContentAccessLevelIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($$sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($$sDBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>