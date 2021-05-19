<?php
function ProEditCompany(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
    if(isset($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access'])
    && ME_MultyCheckNumericType($_POST['CompIndex'], $_POST['County'], $_POST['Access']))
    {
        //format the string to be compatible with HTML and avoid SQL injection
        $sName = ME_SecDataFilter($_POST['Name']);
        $sDate = ME_SecDataFilter($_POST['Date']);

        //variables consindered to be holding ID's
        $iCompanyIndex = (int)$_POST['CompIndex'];
        $iCountyIndex = (int)$_POST['County'];
        $iContentAccess = (int)$_POST['Access'];

        //database cannot accept Primary or foreighn keys below 1
        //If duplicate the database will throw a exception
        if(($iCompanyIndex > 0) && ($iCountyIndex > 0) && CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
        {
            //Get the information of the row to be able to modifie references
            $rResult = CompanySpecificRetriever($InrConn, $InrLogHandle, $iCompanyIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

            //Check result returns one row and it's not empty 
            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iCompanyDataIndex = (int) $aDataRow['COMP_DATA_ID'];
                $iCompanyAccess = (int) $aDataRow['COMP_ACCESS'];

                if(($iCompanyDataIndex > 0) && CheckAccessRange($iCompanyAccess))
                {
                    if(CompanyEditParser($InrConn, $InrLogHandle, $iCompanyIndex, $iCountyIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                    {
                        if(CompanyDataEditParser($InrConn, $InrLogHandle, $iCompanyDataIndex, $sName, $sDate, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                            $InrConn->Commit();
                        else
                        {
                            $InrConn->RollBack();
                            $InrLogHandle->AddLogMessage("Failed to edit data table", __FILE__, __FUNCTION__, __LINE__);
                        }
                    }
                    else
                    {
                        $InrConn->RollBack();
                        $InrLogHandle->AddLogMessage("Failed to edit table", __FILE__, __FUNCTION__, __LINE__);
                    }
                }
                else
                    $InrLogHandle->AddLogMessage("Query returned empty, did not find any ID (Possible data corruption)", __FILE__, __FUNCTION__, __LINE__);

                $rResult->free();
            } 
            else
                $InrLogHandle->AddLogMessage("Could not fetch Table result", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("Some variables do not meet the process requirement range, Check your variables", __FILE__, __FUNCTION__, __LINE__);
	}
	else
        $InrLogHandle->AddLogMessage("Missing or not complete POST variables to finish transaction transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>