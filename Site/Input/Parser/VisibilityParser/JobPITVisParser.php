<?php
function JobPITVisParser(CDBConnManager &$InDBConn, int &$IniJobPitIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniJobPitIndex, $IniIsAvailIndex))
	{
		if(($IniJobPitIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME
			SET
			".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_AVAIL = ".$IniIsAvailIndex."
			WHERE
			".$InDBConn->GetPrefix()."VIEW_JOB_INCOME_TIME.JOB_PIT_ID = ".$IniJobPitIndex.";";

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
