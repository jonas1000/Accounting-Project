<?php
function JobPITAddParser(ME_CDBConnManager &$InDBConn, int &$IniJobIndex, float &$InfPIT, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsDate))
	{
		if(($IniJobIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

			$sDBQuery="INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME
			(
				JOB_ID,
				JOB_PIT,
				JOB_PIT_DATE,
				JOB_PIT_ACCESS,
				JOB_PIT_AVAIL
			)
			VALUES
			(
				".$IniJobIndex.",
				".$InfPIT.",
				\"".$InsDate."\",
				".$IniContentAccessLevelIndex.",
				".$IniIsAvailIndex."
			);";

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
	else
		throw new Exception("Input parameters are empty");
}
?>