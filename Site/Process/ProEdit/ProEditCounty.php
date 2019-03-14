<?php
//-------------<FUNCTION>-------------//
function ProEditCounty(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['CountyIndex'], $_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Date'], $_POST['Country'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['CountyIndex'], $_POST['Name'], $_POST['Date'], $_POST['Country'], $_POST['Access'], $IniUserAccessLevelIndex))
        {
            if(ME_MultyCheckNumericType($_POST['CountyIndex'], $_POST['Country'], $_POST['Access']))
            {
                //take strings as is
                $sName = $_POST['Name'];
                $sDate = $_POST['Date'];

                //Convert data to float for logical methematical operations
                $fTax = (float) $_POST['Tax'];
                $fIR = (float) $_POST['IR'];

                //variables consindered to be holding ID's
                $iCountyIndex = (int) $_POST['CountyIndex'];
                $iCountryIndex = (int) $_POST['Country'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['Name'], $_POST['Date'], $_POST['Tax'], $_POST['IR'], $_POST['Country'], $_POST['Access']);

                //format the string to be compatible with HTML and avoid SQL injection
                ME_SecDataFilter($sName);
                ME_SecDataFilter($sDate);

                //database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
                if(($fTax > -1 && $fTax < 101) && ($fIR > -1 && $fIR < 101) && ($iCountryIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevelIndex > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CountyGeneralSpecificRetriever($InDBConn, $iCountryIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                    $aCountyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCountyNumRows = $InDBConn->GetResultNumRows();

                    //Check result returns one row and it's not empty 
                    if(!empty($aCountyRow) && ($iCountyNumRows > 0 && $iCountyNumRows < 2))
                    {
                        $iCountyDataIndex = (int) $aCountyRow['COU_DATA_ID'];

                        CountyEditParser($InDBConn, $iCountyIndex, $iCountryIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        CountyDataEditParser($InDBConn, $iCountyDataIndex, $sName, $fTax, $fIR, $sDate, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        unset($iCountyDataIndex);
                    }
                    else
                        throw new Exception("Could not fetch result for Company");

                    unset($aCountyRow, $iCountyNumRows);
                }
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                 unset($sName, $sDate, $fTax, $fIR, $iCountyDataIndex, $iCountryIndex, $iContentAccessIndex);
                 header("Location:.?MenuIndex=".$_ENV['MenuIndex']['County']);
            }
            else 
                throw new Exception("Some POST data are not considered numeric type");
        }
        else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>