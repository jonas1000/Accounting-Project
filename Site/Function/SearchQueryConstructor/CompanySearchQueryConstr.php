<?php

function CompanySearchConstructor(string &$InsSearchTypeQuery, string &$InsSearchType, string &$InsSearchQuery) : void
{
	$sVariableFormat = "?";

	switch($InsSearchType)
	{
		case $GLOBALS['COMPANY_SEARCH_TYPE']['COMPANY_TITLE']["NAME"]:
		{
			SearchQueryConstructor($InsSearchQuery);
			$InsSearchTypeQuery .= "COMP_DATA_TITLE";
			break;
		}

		case $GLOBALS['COMPANY_SEARCH_TYPE']['COUNTY_TITLE']["NAME"]:
		{
			SearchQueryConstructor($InsSearchQuery);
			$InsSearchTypeQuery .= "COU_DATA_TITLE";
			break;
		}

		case $GLOBALS['COMPANY_SEARCH_TYPE']['COUNTRY_TITLE']["NAME"]:
		{
			SearchQueryConstructor($InsSearchQuery);
			$InsSearchTypeQuery .= "COUN_DATA_TITLE";
			break;
		}

		case $GLOBALS['COMPANY_SEARCH_TYPE']['COMPANY_DATE']['NAME']:
		{
			$InsSearchTypeQuery .= "DATE_FORMAT(COMP_DATA_DATE, '%Y %m')";
			$sVariableFormat = "DATE_FORMAT(?, '%Y %m')";
			break;
		}

		case $GLOBALS['COMPANY_SEARCH_TYPE']['COUNTY_TAX']["NAME"]:
		{
			SearchQueryConstructor($InsSearchQuery);
			$InsSearchTypeQuery .= "COU_DATA_TAX";
			break;
		}

		case $GLOBALS['COMPANY_SEARCH_TYPE']['COUNTY_IR']["NAME"]:
		{
			SearchQueryConstructor($InsSearchQuery);
			$InsSearchTypeQuery .= "COU_DATA_IR";
			break;
		}

		default:
		{
			SearchQueryConstructor($InsSearchQuery);
			$InsSearchTypeQuery .= "COMP_DATA_TITLE";
			break;
		}
	}

	$InsSearchTypeQuery .= " LIKE " . $sVariableFormat;
}

?>