<?php
//-------------<FUNCTION>-------------//
function ProDelCountry(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess) : void
{
	if(isset($_POST['CounIndex']) && !empty($_POST['CounIndex']) && is_numeric($_POST['CounIndex']))
	{
		//variables consindered to be holding ID
		$iCountryIndex = (int) $_POST['CounIndex'];

		if(($iCountryIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			$rResult = CountrySpecificRetriever($InrConn, $InrLogHandle, $iCountryIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

			if(!empty($rResult) && ($rResult->num_rows == 1))
			{
				$aDataRow = $rResult->fetch_assoc();

				if(CountryVisParser($InrConn, $InrLogHandle, (int) $aDataRow['COUN_ID'], $GLOBALS['AVAILABLE']['Hide']) &&
				CountryDataVisParser($InrConn, $InrLogHandle, (int) $aDataRow['COUN_DATA_ID'], $GLOBALS['AVAILABLE']['Hide']))
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