<?php
function JobSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_TITLE";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_DATE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_DATA_DATE";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_PRICE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_INC_PRICE";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_PIA']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_INC_PIA";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_EXPENSES']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_OUT_EXPENSES";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_DAMAGE']["NAME"]:
		{
			$InsSearchTypeQuery = "JOB_OUT_DAMAGE";
			break;
		}

		case $GLOBALS['JOB_SEARCH_TYPE']['JOB_COMPANY_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "COMPANY_DATA_TITLE";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "JOB_DATA_TITLE";
			break;
		}
	}
}

?>