<?php
function ShareholderSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniShareholderIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
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
        (".$sPrefix."VIEW_SHAREHOLDER.SHARE_ACCESS > ".($IniUserAccessLevel - 1).")
        AND
        (".$sPrefix."VIEW_SHAREHOLDER.SHARE_ID = ".$IniShareholderIndex.");";

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

function ShareholderGeneralSpecificRetriever(ME_CDBConnManager &$InDBConn, int &$IniShareholderIndex, int &$IniUserAccessLevel, int &$IniIsAvailIndex) : void
{
	if(($IniUserAccessLevel > 0) && ($IniIsAvailIndex > 0 && $IniIsAvailIndex < (count($_ENV['Available']) + 1)))
	{
        $sDBQuery = "";
        $sPrefix = $InDBConn->GetPrefix();
        $iUserAccessLevelIndex = $IniUserAccessLevel - 1;

		$sDBQuery = "SELECT 
        SHARE_ID,
        SHARE_ACCESS,
        EMP_ID,
        EMP_ACCESS,
        EMP_DATA_ID,
        EMP_DATA_ACCESS,
        EMP_DATA_SALARY, 
        EMP_DATA_BDAY, 
        EMP_DATA_NAME, 
        EMP_DATA_SURNAME, 
        EMP_DATA_EMAIL,
        EMP_DATA_PN,
        EMP_DATA_SN,
        EMP_POS_ID,
        EMP_POS_ACCESS
        EMP_POS_TITLE,
        COMP_ID,
        COMP_ACCESS,
        COMP_DATA_ID,
        COMP_DATA_ACCESS,
        COMP_DATA_TITLE,
        COU_ID,
        COU_ACCESS,
        COU_DATA_ID,
        COU_DATA_ACCESS
        COU_DATA_TITLE,
        COU_DATA_TAX,
        COU_DATA_IR,
        COU_DATA_DATE,
        COUN_DATA_TITLE
        FROM 
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL 
        WHERE 
        (".$sPrefix."VIEW_SHAREHOLDER_GENERAL.SHARE_AVAIL = ".$IniIsAvailIndex."
        AND 
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.EMP_AVAIL = ".$IniIsAvailIndex." 
        AND 
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.EMP_DATA_AVAIL = ".$IniIsAvailIndex." 
        AND 
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.EMP_POS_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COMP_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COMP_DATA_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COU_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COU_DATA_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COUN_AVAIL = ".$IniIsAvailIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COUN_DATA_AVAIL = ".$IniIsAvailIndex."
        AND 
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.SHARE_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.EMP_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.EMP_DATA_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.EMP_POS_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COMP_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COMP_DATA_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COU_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COU_DATA_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COUN_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.COUN_DATA_ACCESS > ".$iUserAccessLevelIndex."
        AND
        ".$sPrefix."VIEW_SHAREHOLDER_GENERAL.SHARE_ID = ".$IniShareholderIndex.");";

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