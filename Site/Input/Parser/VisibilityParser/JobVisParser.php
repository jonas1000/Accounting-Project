<?php
function JobVisParser(CDBConnManager &$InDBConn, int &$IniJobIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniJobIndex, $IniIsAvailIndex))
	{
		if(($IniJobIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery="UPDATE
			".$InDBConn->GetPrefix()."VIEW_JOB
			SET
			".$InDBConn->GetPrefix()."VIEW_JOB.JOB_AVAIL = " . $IniIsAvailIndex . "
			WHERE
			".$InDBConn->GetPrefix()."VIEW_JOB.JOB_ID = " . $IniJobIndex . ";";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception("warning: " . $InDBConn->GetWarning());
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
