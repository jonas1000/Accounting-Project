<?php
function CustomerSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_NAME']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_Name";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_SURNAME']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_Surname";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_PHONE']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_PN";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_STABLE']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_SN";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_EMAIL']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_Email";
			break;
		}

		case $GLOBALS['CUSTOMER_SEARCH_TYPE']['CUSTOMER_VAT']["NAME"]:
		{
			$InsSearchTypeQuery = "CUST_DATA_VAT";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "CUST_DATA_Name";
			break;
		}
	}
}
?>