<?php
function ProEditEmployeePosition(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access'], $IniUserAccessLevelIndex))
        {
            if(ME_MultyCheckNumericType($_POST['EmpPosIndex'], $_POST['Access']))
            {
                $sName = $_POST['Name'];

                $iEmployeePositionIndex = (int) $_POST['EmpPosIndex'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['EmpPosIndex'], $_POST['Name'], $_POST['Access']);

                ME_SecDataFilter($sName);

                if(($iEmployeePositionIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevelIndex > 0))
                    EmployeePositionEditParser($InDBConn, $iEmployeePositionIndex, $sName, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sName, $iEmployeePositionIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['EmployeePosition']); 
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