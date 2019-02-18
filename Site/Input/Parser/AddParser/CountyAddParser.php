<?php
//-------------<FUNCTION>-------------//
function CountyAddParser(CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniCountryIndex, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniCountryIndex > 0) && ($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COUNTY
			(
			COU_DATA_ID,
			COUN_ID,
			COU_ACCESS,
			COU_AVAIL
			)
			VALUES
			(
			".$InDBConn->GetLastQueryID().",
			".$IniCountryIndex.",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

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

function CountyDataAddParser(CDBConnManager &$InDBConn, string &$InsTitle, float &$InfTax, float &$InfInterestRate, string &$InsDate, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $InsTitle, $InsDate, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COUNTY_DATA
			(
			COU_DATA_TITLE,
			COU_DATA_TAX,
			COU_DATA_IR,
			COU_DATA_DATE,
			COU_DATA_ACCESS,
			COU_DATA_AVAIL
			)
			VALUES
			(
			\"".$InsTitle."\",
			".(empty($InfTax) || ($InfTax < 0) ? 0 : $InfTax).",
			".(empty($InfInterestRate) || ($InfInterestRate < 0) ? 0 : $InfInterestRate).",
			\"".$InsDate."\",
			".$IniAccessIndex.",
			".$IniIsAvailIndex."
			);";

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