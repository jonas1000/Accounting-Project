<?php
//-------------<FUNCTION>-------------//
function ProEditCompany(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['County'], $_POST['Access'], $IniUserAccessLevelIndex))
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
                if(($iCompanyIndex > 0) && ($iCountyIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevelIndex > 0))
                {
                    //Get the information of the row to be able to modifie references
                    CompanyGeneralSpecificRetriever($InDBConn, $iCompanyIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                    $aCompanyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iCompanyNumRows = $InDBConn->GetResultNumRows();

                    //Check result returns one row and it's not empty 
                    if(!empty($aCompanyRow) && $iCompanyNumRows < 2 && $iCompanyNumRows > 0)
                    {
                        $iCompanyDataIndex = (int) $aCompanyRow['COMP_DATA_ID'];

                        CompanyEditParser($InDBConn, $iCompanyIndex, $iCountyIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        CompanyDataEditParser($InDBConn, $iCompanyDataIndex, $sName, $sDate, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        unset($iCompanyDataIndex);
                    } 
                    else
                        throw new Exception("Could not fetch result for Company");

                    unset($aCompanyRow, $iCompanyNumRows);
                }
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sName, $sDate, $aCompanyRow, $iCompanyNumRows);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Company']);
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