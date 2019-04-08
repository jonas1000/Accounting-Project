<?php
//-------------<FUNCTION>-------------//
function ProEditCompany(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['County'], $_POST['Access']))
            {
                //take strings as is
                $sName = $_POST['Name'];
                $sDate = $_POST['Date'];

                //variables consindered to be holding ID's
                $iCompanyIndex = (int) $_POST['CompIndex'];
                $iCountyIndex = (int) $_POST['County'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['Name'], $_POST['Date'], $_POST['CompIndex'], $_POST['County'], $_POST['Access']);

                //format the string to be compatible with HTML and avoid SQL injection
                ME_SecDataFilter($sName);
                ME_SecDataFilter($sDate);

                //database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
                if(($iCompanyIndex > 0) && ($iCountyIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CompanySpecificRetriever($InDBConn, $iCompanyIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aCompanyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCompanyNumRows = $InDBConn->GetResultNumRows();

                    //Check result returns one row and it's not empty 
                    if(!empty($aCompanyRow) && ($iCompanyNumRows < 2 && $iCompanyNumRows > 0))
                    {
                        $iCompanyDataIndex = (int) $aCompanyRow['COMP_DATA_ID'];
                        $iCompanyAccessLevel = (int) $aCompanyRow['COMP_ACCESS'];

                        if(($iCompanyDataIndex > 0) && ($iCompanyAccessLevel > 0))
                        {
                            if($iCompanyAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                CompanyEditParser($InDBConn, $iCompanyIndex, $iCountyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);

                                CompanyDataEditParser($InDBConn, $iCompanyDataIndex, $sName, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iCompanyDataIndex, $iCompanyAccessLevel);
                    } 
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aCompanyRow, $iCompanyNumRows);
                }
                else
                    throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                unset($sName, $sDate, $iCompanyIndex, $iCountyIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Company']);
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