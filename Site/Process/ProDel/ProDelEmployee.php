<?php
//-------------<FUNCTION>-------------//
function ProDelEmployee(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess) : void
{
	if(isset($_POST['EmpIndex']) && !empty($_POST['EmpIndex']) && is_numeric($_POST['EmpIndex']))
	{
		//variables consindered to be holding ID
		$iEmployeeIndex = (int) $_POST['EmpIndex'];

		if(($iEmployeeIndex > 0) && CheckAccessRange($IniUserAccess))
		{
			$rResult = EmployeeSpecificRetriever($InrConn, $InrLogHandle, $iEmployeeIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

			if(!empty($rResult) && ($rResult->num_rows == 1))
			{
				$aDataRow = $rResult->fetch_assoc();

				if(EmployeeVisParser($InrConn, $InrLogHandle, (int) $aDataRow['EMP_ID'], $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
					$InrConn->RollBack();

				if(EmployeeDataVisParser($InrConn, $InrLogHandle, (int) $aDataRow['EMP_DATA_ID'], $GLOBALS['AVAILABLE']['Hide']))
					$InrConn->Commit();
				else
					$InrConn->RollBack();

				$rResult->free();
			}
			else
				$InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
		}
		else
			$InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);

		header("Location:Index.php?MenuIndex=" . $GLOBALS['MENU_INDEX']['Employee']);
	}
	else
		$InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>