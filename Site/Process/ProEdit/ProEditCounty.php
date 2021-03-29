<?php
function ProEditCounty(ME_CDBConnManager &$InrConn, ME_CLogHandle &$InrLogHandle, int &$IniUserAccess)
{
    if(isset($_POST['CountyIndex'], $_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Country'], $_POST['Access']) 
    && !ME_MultyCheckEmptyType($_POST['CountyIndex'], $_POST['Name'], $_POST['Country'], $_POST['Access']) 
    && ME_MultyCheckNumericType($_POST['CountyIndex'], $_POST['Country'], $_POST['Access']))
    {
        //format the string to be compatible with HTML and avoid SQL injection
        $sName = ME_SecDataFilter($_POST['Name']);

        //Convert data to float for logical methematical operations
        $fTax = (float)$_POST['Tax'];
        $fIR = (float)$_POST['IR'];

        //variables consindered to be holding ID's
        $iCountyIndex = (int)$_POST['CountyIndex'];
        $iCountryIndex = (int)$_POST['Country'];
        $iContentAccess = (int)$_POST['Access'];

        //database cannot accept Primary or foreighn keys below 1
        //If duplicate the database will throw a exception
        if(($fTax > -1 && $fTax < 101) && ($fIR > -1 && $fIR < 101) && ($iCountryIndex > 0) && CheckAccessRange($iContentAccess) && CheckAccessRange($IniUserAccess))
        {
            //Get the information of the row to be able to modifie references
            $rResult = CountySpecificRetriever($InrConn, $InrLogHandle, $iCountyIndex, $IniUserAccess, $GLOBALS['AVAILABLE']['Show']);

            //Check result returns one row and it's not empty 
            if(!empty($rResult) && ($rResult->num_rows == 1))
            {
                $aDataRow = $rResult->fetch_assoc();

                $iCountyDataIndex = (int) $aDataRow['COU_DATA_ID'];
                $iCountyAccessLevel = (int) $aDataRow['COU_ACCESS'];

                if(($iCountyDataIndex > 0) && ($iCountyAccessLevel > 0))
                {
                    if(CountyEditParser($InrConn, $InrLogHandle, $iCountyIndex, $iCountryIndex, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
                    {
                        if(CountyDataEditParser($InrConn, $InrLogHandle, $iCountyDataIndex, $sName, $fTax, $fIR, $iContentAccess, $GLOBALS['AVAILABLE']['Show']))
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

        header("Location:.?MenuIndex=".$GLOBALS['MENU_INDEX']['County']);
	}
	else
        $InrLogHandle->AddLogMessage("Missing POST variables to complete transaction", __FILE__, __FUNCTION__, __LINE__);
}
?>