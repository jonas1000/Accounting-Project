<?php
function JobPITAddParser(CDBConnManager &$InDBConn, int &$IniJobIndex, float &$InfPit, string &$InsDate, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniJobIndex, $InsDate, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniJobIndex > 0) && ($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
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
				".(empty($InfPit) ? 0 : $InfPit).",
				\"".$InsDate."\",
				".$IniAccessIndex.",
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
