<?php
//-------------<FUNCTION>-------------//
function ProDelCounty(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
	if(isset($_POST['CouIndex']) && !empty($_POST['CouIndex']) && is_numeric($_POST['CouIndex']))
	{
		//variables consindered to be holding ID
		$iCountyIndex = (int) $_POST['CouIndex'];

		if(($iCountyIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			$rResult = CountySpecificRetriever($InrConn, $InrLogHandle, $iCountyIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

			if(!empty($rResult) && ($rResult->num_rows == 1))
			{
				$aDataRow = $rResult->fetch_assoc();

				if(CountyVisParser($InrDBConn, $InrLogHandle, (int) $aDataRow['COU_ID'], $GLOBALS['AVAILABLE']['Hide']) &&
				CountyDataVisParser($InrDBConn, $InrLogHandle, (int) $aDataRow['COU_DATA_ID'], $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
				{
					$InrConn->RollBack();
					$InrLogHandle->AddLogMessage("Failed to update tables", __FILE__, __FUNCTION__, __LINE__);
				}

				$rResult->free();
			}
			else
				$InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>