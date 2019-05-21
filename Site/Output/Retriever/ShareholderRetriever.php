<?php
function ShareholderRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		".$sPrefix."VIEW_SHAREHOLDER.SHARE_ID,
		".$sPrefix."VIEW_SHAREHOLDER.EMP_ID,
		".$sPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS
		FROM
		".$sPrefix."VIEW_SHAREHOLDER
		WHERE
		(".$sPrefix."VIEW_SHAREHOLDER.SHARE_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS > ".($IniUserAccessLevel- 1).")
		ORDER BY SHARE_ID DESC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
		else
			throw new Exception("Input parameters do not meet requirements range");
}

function ShareholderOverviewRetriever(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
		$sDBQuery = "";
		$sPrefix = $InDBConn->GetPrefix();

		$sDBQuery = "SELECT
		SHARE_ID,
		EMP_DATA_ACCESS,
		EMP_DATA_SALARY,
		EMP_DATA_BDAY,
		EMP_DATA_NAME,
		EMP_DATA_SURNAME,
		EMP_DATA_EMAIL,
		EMP_POS_TITLE
		FROM
		".$sPrefix."VIEW_SHAREHOLDER_OVERVIEW
		WHERE
		(".$sPrefix."VIEW_SHAREHOLDER_OVERVIEW.SHARE_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_SHAREHOLDER_OVERVIEW.EMP_DATA_AVAIL = ".$IniIsAvailIndex."
		AND
		".$sPrefix."VIEW_SHAREHOLDER_OVERVIEW.EMP_POS_AVAIL = ".$IniIsAvailIndex.")
		AND
		(".$sPrefix."VIEW_SHAREHOLDER_OVERVIEW.SHARE_ACCESS > ".($IniUserAccessLevel - 1).")
		ORDER BY SHARE_ID DESC;";

		$InDBConn->ExecQuery($sDBQuery, FALSE);

		if(!$InDBConn->HasError())
		{
			if($InDBConn->HasWarning())
				throw new Exception($InDBConn->GetWarning());
		}
		else
			throw new Exception($InDBConn->GetError());

		unset($sDBQuery, $sPrefix);
	}
		else
			throw new Exception("Input parameters do not meet requirements range");
}
?>