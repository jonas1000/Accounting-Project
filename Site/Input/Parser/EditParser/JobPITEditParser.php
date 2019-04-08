<?php
function JobPITEditParser(ME_CDBConnManager &$InDBConn, int &$IniJobPITIndex, float &$InfPIT, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsDate))
	{
		if(($IniJobPITIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";
			$sPrefix = $InDBConn->GetPrefix();

			$sDBQuery="UPDATE
			".$sPrefix."VIEW_JOB_INCOME_TIME_EDIT
			SET
			".$sPrefix."VIEW_JOB_INCOME_TIME_EDIT.JOB_PIT_PAYMENT = ".(empty($InfPIT) ? 0 : $InfPIT).",
			".$sPrefix."VIEW_JOB_INCOME_TIME_EDIT.JOB_PIT_ACCESS_ID = ".$IniContentAccessLevelIndex."
			WHERE
			(".$sPrefix."VIEW_JOB_INCOME_TIME_EDIT.JOB_PIT_AVAIL_ID = ".$IniIsAvailIndex.")
			AND
			(".$sPrefix."VIEW_JOB_INCOME_TIME_EDIT.JOB_PIT_ID = ".$IniJobPITIndex.");";

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