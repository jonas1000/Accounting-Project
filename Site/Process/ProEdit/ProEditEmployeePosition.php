<?php
function ProEditEmployeePosition(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['EmpPosIndex'], $_POST['Access']))
            {
                $sName = $_POST['Name'];

                $iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']);

                ME_SecDataFilter($sName);

                if(($iEmployeePositionIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    EmployeePositionSpecificRetriever($InDBConn, $iEmployeePositionIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aEmployeePositionRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iEmployeePositionNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aEmployeePositionRow) && ($iEmployeePositionNumRows > 0 && $iEmployeePositionNumRows < 2))
                    {
                        $iEmployeePositionAccessLevel = (int) $aEmployeePositionRow['EMP_POS_ACCESS'];

                        if($iEmployeePositionAccessLevel > 0)
                        {
                            if($iEmployeePositionAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                EmployeePositionEditParser($InDBConn, $iEmployeePositionIndex, $sName, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iEmployeePositionAccessLevel);
                    }
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aEmployeePositionRow, $iEmployeePositionNumRows);
                }
                else
                   throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                unset($sName, $iEmployeePositionIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['EmployeePosition']); 
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