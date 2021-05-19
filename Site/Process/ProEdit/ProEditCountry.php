<?php
function ProEditCountry(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int $IniUserAccess)
{
    if(isset($_POST['CounIndex'], $_POST['Name'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['CounIndex'], $_POST['Name'], $_POST['Access']) 
    && ME_MultyCheckNumericType($_POST['CounIndex'], $_POST['Access']))
    {
        //format the string to be compatible with HTML and avoid SQL injection
        $sName = ME_SecDataFilter($_POST['Name']);

        //variables consindered to be holding ID's
        $iContentAccess = (int)$_POST['Access'];
        $iCountryIndex = (int)$_POST['CounIndex'];

        //database cannot accept Primary or foreighn keys below 1
        //If duplicate the database will throw a exception
        if(CheckAccessRange($iContentAccess) && ($iCountryIndex > 0) && CheckAccessRange($IniUserAccess))
        {
            //Get the information of the row to be able to modifie references
            $rResult = CountrySpecificRetriever($InrConn, $InrLogHandle, $iCountryIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['SHOW']);

            //Check result returns one row and it's not empty 
            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iCountryDataIndex = (int) $aDataRow['COUN_DATA_ID'];
                $iCountryAccess = (int) $aDataRow['COUN_ACCESS'];

                if(($iCountryDataIndex > 0) && CheckAccessRange($iCountryAccess))
                {
                    if(CountryEditParser($InrConn, $InrLogHandle, $iCountryIndex, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
                    {
                        if(CountryDataEditParser($InrConn, $InrLogHandle,  $iCountryDataIndex, $sName, $iContentAccess, $GLOBALS['AVAILABLE']['SHOW']))
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
        $InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>