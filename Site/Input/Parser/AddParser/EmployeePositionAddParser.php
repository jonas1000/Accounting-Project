<?php
function EmployeePositionAddParser(CDBConnManager &$InDBConn, string &$InsName, int $IniAccessIndex, int $IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsName, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$DBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_EMPLOYEE_POSITION
			(
			EMP_POS_TITLE,
			EMP_POS_ACCESS,
			EMP_POS_AVAIL
			)
			VALUES
			(
			\"".$InsName."\",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($DBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception($InDBConn->GetWarning());
			}
			else
				throw new Exception($InDBConn->GetError());

			unset($DBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>
