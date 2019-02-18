<?php
//-------------<FUNCTION>-------------//
function CountryAddParser(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COUNTRY
			(
			COUN_DATA_ID,
			COUN_ACCESS,
			COUN_AVAIL
			)
			VALUES
			(
			".$InDBConn->GetLastQueryID().",
			".$IniAccessIndex.",
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

function CountryDataAddParser(CDBConnManager &$InDBConn, string &$InsTitle, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsTitle, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_DATA
			(
			COUN_DATA_TITLE,
			COUN_DATA_ACCESS,
			COUN_DATA_AVAIL
			)
			VALUES
			(
			\"".$InsTitle."\",
			".$IniAccessIndex.",
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