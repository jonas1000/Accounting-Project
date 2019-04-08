<?php
//-------------<FUNCTION>-------------//
function ProEditCountry(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['CounIndex'], $_POST['Name'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['CounIndex'], $_POST['Name'], $_POST['Access']))
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
                if(($iContentAccessIndex > 0) && ($iCountryIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CountrySpecificRetriever($InDBConn, $iCountryIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aCountryRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCountryNumRow = $InDBConn->GetResultNumRows();

                    //Check result returns one row and it's not empty 
                    if(!empty($aCountryRow) && ($iCountryNumRow > 0) && ($iCountryNumRow < 2))
                    {
                        $iCountryDataIndex = (int) $aCountryRow['COUN_DATA_ID'];
                        $iCountryAccessLevel = (int) $aCountryRow['COUN_ACCESS'];

                        if(($iCountryDataIndex > 0) && ($iCountryAccessLevel > 0))
                        {
                            if($iCountryAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                CountryEditParser($InDBConn, $iCountryIndex, $iContentAccessIndex, $_ENV['Available']['Show']);

                                CountryDataEditParser($InDBConn,  $iCountryDataIndex, $sName, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iCountryDataIndex, $iCountryAccessLevel);
                    }
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aCountryRow, $iCountryNumRow);
                }
                else
                    throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                unset($sName, $sDate, $iContentAccessIndex, $iCountryIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Country']);
            }
            else 
                throw new Exception("Some POST variables are not considered numeric type");
		}
		else
			throw new Exception("Some POST variables are empty, Those POST variables cannot be empty");
	}
	else
		throw new Exception("Missing POST variables to complete transaction");
}
?>