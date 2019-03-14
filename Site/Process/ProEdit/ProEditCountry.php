<?php
//-------------<FUNCTION>-------------//
function ProEditCountry(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['CounIndex'], $_POST['Name'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['CounIndex'], $_POST['Name'], $_POST['Access'], $IniUserAccessLevelIndex))
        {
            if(ME_MultyCheckNumericType($_POST['CounIndex'], $_POST['Access']))
            {
                //take strings as is
                $sName = $_POST['Name'];

                //variables consindered to be holding ID's
                $iContentAccessIndex = (int) $_POST['Access'];
                $iCountryIndex = (int) $_POST['CounIndex'];

                unset($_POST['CounIndex'], $_POST['Name'], $_POST['Access']);

                //format the string to be compatible with HTML and avoid SQL injection
                ME_SecDataFilter($sName);

                //database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
                if(($iContentAccessIndex > 0) && ($iCountryIndex > 0) && ($IniUserAccessLevelIndex > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CountryGeneralSpecificRetriever($InDBConn, $iCountryIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                    $aCountryRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCountryNumRow = $InDBConn->GetResultNumRows();

                    //Check result returns one row and it's not empty 
                    if(!empty($aCountryRow) && ($iCountryNumRow > 0) && ($iCountryNumRow < 2))
                    {
                        $iCountryDataIndex = (int) $aCountryRow['COUN_DATA_ID'];

                        CountryEditParser($InDBConn, $iCountryIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        CountryDataEditParser($InDBConn,  $iCountryDataIndex, $sName, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        unset($iCountryDataIndex);
                    }
                    else
                        throw new Exception("Could not fetch result for Company");

                    unset($aCountryRow, $iCountryNumRow);
                }
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sName, $sAccess, $sCountry, $iContentAccessIndex, $iCountryIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Country']);
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