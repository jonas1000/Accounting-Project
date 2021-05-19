<?php
function CountySpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountyIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountyIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
        COU_ID,
        COU_DATA_ID,
        COUN_ID,
        COU_ACCESS
        FROM ".$InrConn->GetPrefix()."VIEW_COUNTY
        WHERE (COU_AVAIL = ?)
        AND (COU_ACCESS >= ?)
        AND (COU_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCountyIndex))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}

function CountyDataSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountyDataIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountyDataIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$rStatement = 0;

		$sQuery = "SELECT
        COU_DATA_ID,
        COU_DATA_TITLE,
        COU_DATA_TAX,
        COU_DATA_IR,
        COU_DATA_ACCESS
        FROM ".$InrConn->GetPrefix()."VIEW_COUNTY_DATA
        WHERE (COU_DATA_AVAIL = ?)
        AND (COU_DATA_ACCESS >= ?)
        AND (COU_DATA_ID = ?);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iii", $IniAvail, $IniUserAccess, $IniCountyDataIndex))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}

function CountyEditFormSpecificRetriever(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniCountyIndex, int $IniUserAccess, int $IniAvail)
{
	if(CheckAccessRange($IniUserAccess) &&
	($IniCountyIndex > 0) &&
	CheckRange($IniAvail, $GLOBALS['AVAILABLE_ARRAY_SIZE'], 0))
	{
		$sPrefix = $InrConn->GetPrefix();

		$rStatement = 0;

		$sQuery = "SELECT
        ".$sPrefix."VIEW_COUNTY.COU_ID,
        ".$sPrefix."VIEW_COUNTY.COUN_ID,
        ".$sPrefix."VIEW_COUNTY.COU_ACCESS,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TITLE,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_TAX,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_IR,
        ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS
        FROM ".$sPrefix."VIEW_COUNTY, ".$sPrefix."VIEW_COUNTY_DATA
        WHERE (".$sPrefix."VIEW_COUNTY.COU_AVAIL = ? AND ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_AVAIL = ?)
        AND (".$sPrefix."VIEW_COUNTY.COU_ACCESS > ? AND ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ACCESS >= ?)
        AND (".$sPrefix."VIEW_COUNTY.COU_ID = ?)
        AND (".$sPrefix."VIEW_COUNTY.COU_DATA_ID = ".$sPrefix."VIEW_COUNTY_DATA.COU_DATA_ID);";

		if($rStatement = $InrConn->CreateStatement($sQuery))
		{
			//Check if the statement binded the variables, else throw an exception with the error
			if($rStatement->bind_param("iiiii", $IniAvail, $IniAvail, $IniUserAccess, $IniUserAccess, $IniCountyIndex))
				return ME_SQLStatementExecAndResult($InrConn, $rStatement, $InrLogHandle);
			else
				$InrLogHandle->AddLogMessage("Error Binding parameters to query", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Error creating statement object", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Input parameters do not meet requirements range", __FILE__, __FUNCTION__, __LINE__);

	return FALSE;
}
?>