<?php
function JobPITVisParser(ME_CDBConnManager &$InDBConn, int &$IniJobPitIndex, int &$IniIsAvailIndex) : void
{
	if(($IniJobPitIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery="UPDATE
		".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY
		SET
		".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY.JOB_PIT_AVAIL_ID = ".$IniIsAvailIndex."
		WHERE
		(".$sPrefix."VIEW_JOB_INCOME_TIME_VISIBILITY.JOB_PIT_ID = ".$IniJobPitIndex.");";

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