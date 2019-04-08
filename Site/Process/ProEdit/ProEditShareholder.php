<?php
function ProEditShareholder(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
            {
                $iShareholderIndex = (int) $_POST['ShareIndex'];
                $iEmployeeIndex = (int) $_POST['Employee'];
                $iContentAccessIndex = (int) $_POST['Access'];

                if(($iShareholderIndex > 0) && ($iEmployeeIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    ShareholderSpecificRetriever($InDBConn, $iShareholderIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aShareholderRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iShareholderNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aShareholderRow) && ($iShareholderNumRows > 0 && $iShareholderNumRows < 2))
                    {
                        $iShareholderAccessLevel = (int) $aShareholderRow['SHARE_ACCESS'];

                        if($iShareholderAccessLevel > 0)
                        {
                            if($iShareholderAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                ShareholderEditParser($InDBConn, $iShareholderIndex, $iEmployeeIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iShareholderAccessLevel);
                    }
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aShareholderRow, $iShareholderNumRows);
                }
                else
                    throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                unset($iShareholderIndex, $iEmployeeIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Shareholder']);
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