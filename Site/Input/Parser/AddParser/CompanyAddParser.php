<?php
//-------------<FUNCTION>-------------//
function CompanyAddParser(CDBConnManager &$InDBConn, int &$IniCountyIndex, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniCountyIndex, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniCountyIndex > 0) && ($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
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

function CompanyDataAddParser(CDBConnManager &$InDBConn, string &$InsName, string &$InsDate, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsName, $InsDate, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
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