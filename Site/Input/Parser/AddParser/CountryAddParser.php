<?php
//-------------<FUNCTION>-------------//
function CountryAddParser(ME_CDBConnManager &$InDBConn, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_COUNTRY_ADD
		(
		COUN_DATA_ID,
		COUN_ACCESS_ID,
		COUN_AVAIL_ID
		)
		VALUES
		(
		".$InDBConn->GetLastQueryID().",
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

function CountryDataAddParser(ME_CDBConnManager &$InDBConn, string &$InsTitle, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsTitle))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_DATA_ADD
			(
			COUN_DATA_TITLE,
			COUN_DATA_ACCESS_ID,
			COUN_DATA_AVAIL_ID
			)
			VALUES
			(
			\"".$InsTitle."\",
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