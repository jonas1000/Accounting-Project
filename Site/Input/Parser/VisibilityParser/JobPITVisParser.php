<?php
function JobPITVisParser(ME_CDBConnManager &$InDBConn, int &$IniJobPitIndex, int &$IniUserAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobPitIndex > 0) && ($IniUserAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery="UPDATE
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME
		SET
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = ".$IniIsAvailIndex."
		WHERE
		(".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ID = ".$IniJobPitIndex."
		AND
		".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ACCESS > ".($IniUserAccessLevelIndex - 1).");";

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
?>
