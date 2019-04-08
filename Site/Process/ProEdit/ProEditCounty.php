<?php
//-------------<FUNCTION>-------------//
function ProEditCounty(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['CountyIndex'], $_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Country'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['CountyIndex'], $_POST['Name'], $_POST['Country'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['CountyIndex'], $_POST['Country'], $_POST['Access']))
            {
                //take strings as is
                $sName = $_POST['Name'];

                //Convert data to float for logical methematical operations
                $fTax = (float) $_POST['Tax'];
                $fIR = (float) $_POST['IR'];

                //variables consindered to be holding ID's
                $iCountyIndex = (int) $_POST['CountyIndex'];
                $iCountryIndex = (int) $_POST['Country'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Country'], $_POST['Access']);

                //format the string to be compatible with HTML and avoid SQL injection
                ME_SecDataFilter($sName);

                //database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
                if(($fTax > -1 && $fTax < 101) && ($fIR > -1 && $fIR < 101) && ($iCountryIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CountySpecificRetriever($InDBConn, $iCountyIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aCountyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCountyNumRows = $InDBConn->GetResultNumRows();

                    //Check result returns one row and it's not empty 
                    if(!empty($aCountyRow) && ($iCountyNumRows > 0 && $iCountyNumRows < 2))
                    {
                        $iCountyDataIndex = (int) $aCountyRow['COU_DATA_ID'];
                        $iCountyAccessLevel = (int) $aCountyRow['COU_ACCESS'];

                        if(($iCountyDataIndex > 0) && ($iCountyAccessLevel > 0))
                        {
                            if($iCountyAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                CountyEditParser($InDBConn, $iCountyIndex, $iCountryIndex, $iContentAccessIndex, $_ENV['Available']['Show']);

                                CountyDataEditParser($InDBConn, $iCountyDataIndex, $sName, $fTax, $fIR, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iCountyDataIndex, $iCountyAccessLevel);
                    }
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aCountyRow, $iCountyNumRows);
                }
                else
                    throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                 unset($sName, $sDate, $fTax, $fIR, $iCountyDataIndex, $iCountryIndex, $iContentAccessIndex);
                 header("Location:.?MenuIndex=".$_ENV['MenuIndex']['County']);
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