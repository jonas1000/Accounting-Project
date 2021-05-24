<?php
function EmployeePosSearchConstructor(string &$InsSearchTypeQuery, string &$IniSearchType) : void
{
	switch($IniSearchType)
	{
		case $GLOBALS['EMPLOYEE_POSITION_SEARCH_TYPE']['EMPLOYEE_POSITION_TITLE']["NAME"]:
		{
			$InsSearchTypeQuery = "EMP_POS_TITLE";
			break;
		}

		default:
		{
			$InsSearchTypeQuery = "EMP_POS_TITLE";
			break;
		}
	}
}
?>