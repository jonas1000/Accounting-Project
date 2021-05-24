<?php
function CountySearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['COUNTY_SEARCH_TYPE']['COUNTY_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "COU_DATA_TITLE";
			break;
		}

		case $GLOBALS['COUNTY_SEARCH_TYPE']['COUNTY_TAX']["NAME"]:
		{
			$InsSearchTypeQuery = "COU_DATA_TAX";
			break;
		}

		case $GLOBALS['COUNTY_SEARCH_TYPE']['COUNTY_IR']["NAME"]:
		{
			$InsSearchTypeQuery = "COU_DATA_IR";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "COU_DATA_TITLE";
			break;
		}
	}
}
?>