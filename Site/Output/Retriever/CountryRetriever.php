<?php
function CountryGeneralRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			COUN_ID,
			COUN_AVAIL,
			COUN_ACCESS,
			COUN_DATA_ID,
			COUN_DATA_ACCESS,
			COUN_DATA_AVAIL,
			COUN_DATA_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL
			WHERE
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniAccessIndex - 1).";";

			$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function CountryOverviewRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			COUN_ID,
			COUN_DATA_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL
			WHERE
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniAccessIndex - 1).";";

			$InDBConn->ExecQuery($sDBQuery, FALSE);

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

function CountryFormRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			COUN_ID,
			COUN_DATA_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL
			WHERE
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_DATA_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COUNTRY_GENERAL.COUN_ACCESS > ".($IniAccessIndex - 1).";";

			$InDBConn->ExecQuery($sDBQuery, FALSE);

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