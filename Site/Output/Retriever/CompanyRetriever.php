<?php
function CompanyGeneralRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if($IniAccessIndex > 0 && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			COMP_ID,
			COMP_ACCESS,
			COMP_AVAIL,
			COU_ID,
			COMP_DATA_ID,
			COMP_DATA_ACCESS,
			COMP_DATA_AVAIL,
			COMP_DATA_TITLE,
			COMP_DATA_DATE,
			COUN_DATA_TITLE,
			COU_DATA_TITLE,
			COU_DATA_TAX,
			COU_DATA_IR,
			COU_DATA_DATE
			FROM
			".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL
			WHERE
			(".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_DATA_AVAIL = " . $IniIsAvailIndex . ")
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_ACCESS > ".($IniAccessIndex - 1).";";

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

function CompanyOverviewRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			COMP_ID,
			COMP_ACCESS,
			COMP_AVAIL,
			COMP_DATA_AVAIL,
			COMP_DATA_TITLE,
			COMP_DATA_DATE,
			COUN_DATA_TITLE,
			COU_DATA_TITLE,
			COU_DATA_TAX,
			COU_DATA_IR
			FROM
			".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL
			WHERE
			(".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_AVAIL = " . $IniIsAvailIndex . "
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_DATA_AVAIL = " . $IniIsAvailIndex . ")
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY_GENERAL.COMP_ACCESS > ".($IniAccessIndex - 1).";";

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

function CompanyFormRetriever(CDBConnManager &$InDBConn, int &$IniAccessIndex, int &$IniIsAvailIndex) : void
{
	if(ME_MultyCheckEmptyType($InDBConn, $IniAccessIndex, $IniIsAvailIndex))
	{
		if(($IniAccessIndex > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
		{
			$sDBQuery = NULL;

			$sDBQuery = "SELECT
			COMP_ID,
			COMP_DATA_TITLE
			FROM
			".$InDBConn->GetPrefix()."VIEW_COMPANY,
			".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA
			WHERE
			".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_AVAIL = ".$IniIsAvailIndex."
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_DATA_ID = ".$InDBConn->GetPrefix()."VIEW_COMPANY_DATA.COMP_DATA_ID
			AND
			".$InDBConn->GetPrefix()."VIEW_COMPANY.COMP_ACCESS > ".($IniAccessIndex - 1).";";

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