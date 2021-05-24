<?php
function EmployeeSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_NAME']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_NAME";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_SURNAME']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SURNAME";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_PHONE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_PN";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_STABLE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SN";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_EMAIL']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_EMAIL";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_SALARY']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_SALARY";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_TITLE";
			break;
		}

		case $GLOBALS['EMPLOYEE_SEARCH_TYPE']['EMPLOYEE_BIRTH_DATE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_DATA_BDAY";
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