<?php
//-------------<FUNCTION>-------------//
function CountyAddParser(ME_CDBConnManager &$InDBConn, int &$IniCountryIndex, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(($IniCountryIndex > 0) && ($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";

		$sDBQuery = "INSERT INTO
		".$InDBConn->GetPrefix()."VIEW_COUNTY_ADD
		(
		COU_DATA_ID,
		COUN_ID,
		COU_ACCESS_ID,
		COU_AVAIL_ID
		)
		VALUES
		(
		".$InDBConn->GetLastQueryID().",
		".$IniCountryIndex.",
		".$IniContentAccessLevelIndex.",
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

function CountyDataAddParser(ME_CDBConnManager &$InDBConn, string &$InsTitle, float &$InfTax, float &$InfInterestRate, int &$IniContentAccessLevelIndex, int &$IniIsAvailIndex) : void
{
	if(!empty($InsTitle))
	{
		if(($IniContentAccessLevelIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = "";

			$sDBQuery = "INSERT INTO
			".$InDBConn->GetPrefix()."VIEW_COUNTY_DATA_ADD
			(
			COU_DATA_TITLE,
			COU_DATA_TAX,
			COU_DATA_IR,
			COU_DATA_ACCESS_ID,
			COU_DATA_AVAIL_ID
			)
			VALUES
			(
			\"".$InsTitle."\",
			".abs($InfTax).",
			".abs($InfInterestRate).",
			".$IniContentAccessLevelIndex.",
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