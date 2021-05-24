<?php
function ShareholderSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_NAME']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_SURNAME']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SURNAME";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_EMAIL']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_EMAIL";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_BIRTH_DATE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_BDAY";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_POSITION_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_POS_TITLE";
			break;
		}

		case $GLOBALS['SHAREHOLDER_SEARCH_TYPE']['SHAREHOLDER_SALARY']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SALARY";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}
	}
}
?>