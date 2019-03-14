<?php
function JobPITAddParser(ME_CDBConnManager &$InDBConn, int &$IniJobPITIndex, float &$InfPIT, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsDate))
	{
		if(($IniJobPITIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery="UPDATE
            ".$sPrefix."VIEW_JOB_INCOME_TIME
            SET
            ".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT = ".$InfPIT.",
            ".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_DATE = \"".$InsDate."\",
            ".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS = ".$IniContentAccessLevelIndex."
            WHERE
			(".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_ID = ".$IniJobPITIndex."
			AND
			".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS > ".($IniUserAccessLevelIndex - 1)."
			AND
			".$sPrefix."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = ".$IniIsAvailIndex.");";

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