<?php
//-------------<FUNCTION>-------------//
function ProDelCompany(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['CompIndex']) && !empty($_POST['CompIndex']) &&	is_numeric($_POST['CompIndex']))
	{
		//variables consindered to be holding ID
		$iCompanyIndex = (int) $_POST['CompIndex'];

		if(($iCompanyIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			$rResult = CompanySpecificRetriever($InrConn, $InrLogHandle, $iCompanyIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

			if(!empty($rResult) && ($rResult->num_rows == 1))
			{
				$aDataRow = $rResult->fetch_assoc();

				if(CompanyVisParser($InrConn, $InrLogHandle, (int) $aDataRow['COMP_ID'], $GLOBALS['AVAILABLE']['HIDE']) &&
				CompanyDataVisParser($InrConn, $InrLogHandle, (int) $aDataRow['COMP_DATA_ID'], $GLOBALS['AVAILABLE']['HIDE']))
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