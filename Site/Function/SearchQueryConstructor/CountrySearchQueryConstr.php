<?php
function CountrySearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['COUNTRY_SEARCH_TYPE']['COUNTRY_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "COUN_DATA_TITLE";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "COUN_DATA_TITLE";
			break;
		}
	}
}
?>