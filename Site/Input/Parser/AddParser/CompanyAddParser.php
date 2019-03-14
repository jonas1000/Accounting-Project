<?php
//-------------<FUNCTION>-------------//
function CompanyAddParser(ME_CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountyIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_COMPANY
		(
		COMP_DATA_ID,
		COU_ID,
		COMP_ACCESS,
		COMP_AVAIL
		)
		VALUES
		(".$InDBConn->GetLastQueryID().",
		".$IniCountyIndex.",
		".$IniContentAccessLevelIndex.",
		".$IniIsAvailIndex."
		);";

		$InDBConn->ExecQuery($sDBQuery, TRUE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception("warning detected: " . $InDBConn->GetWarning());
		}
		else
			throw new Exception("Error: " . $InDBConn->GetError());

		unset($sDBQuery);
	}
	else
		throw new Exception("Input parameters do not meet requirements range");
}

function CompanyDataAddParser(ME_CDBConnManager &$InDBConn, string &$InsName, string &$InsDate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InsName, $InsDate))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA
			(
			COMP_DATA_TITLE,
			COMP_DATA_DATE,
			COMP_DATA_ACCESS,
			COMP_DATA_AVAIL
			)
			VALUES
			(
			\"".$InsName."\",
			\"".$InsDate."\",
			".$IniContentAccessLevelIndex.",
			".$IniIsAvailIndex."
			);";

			$InDBConn->ExecQuery($sDBQuery, TRUE);

			if(!$InDBConn->HasError())
			{
				if($InDBConn->HasWarning())
					throw new Exception("warning detected: " . $InDBConn->GetWarning());
			}
			else
				throw new Exception("Error: " . $InDBConn->GetError());

			unset($sDBQuery);
		}
		else
			throw new Exception("Input parameters do not meet requirements range");
	}
	else
		throw new Exception("Input parameters are empty");
}
?>