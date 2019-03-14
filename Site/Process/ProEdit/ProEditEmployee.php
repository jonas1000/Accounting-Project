<?php
function ProEditEmployee(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex)
{
    if(isset($_POST['EmployeeIndex'], $_POST['Name'], $_POST['Surname'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['EmployeeIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PN'], $IniUserAccessLevelIndex))
        {
            if(ME_MultyCheckNumericType($_POST['EmployeeIndex'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access']))
            {
                $sName = $_POST['Name'];
                $sSurname = $_POST['Surname'];
                $sEmail = $_POST['Email'];
                $sPhoneNumber = $_POST['PN'];
                $sStableNumber = $_POST['SN'];
                $sBDay = $_POST['BDay'];

                $fSalary = (float) $_POST['Salary'];
                $iEmployeeIndex = (int) $_POST['EmployeeIndex'];
                $iCompanyIndex = (int) $_POST['Company'];
                $iEmployeePositionIndex = (int) $_POST['EmployeePosition'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset($_POST['EmpIndex'], $_POST['Name'], $_POST['Surname'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access']);

                ME_SecDataFilter($sName);
                ME_SecDataFilter($sSurname);
                ME_SecDataFilter($sEmail);
                ME_SecDataFilter($sPhoneNumber);
                ME_SecDataFilter($sStableNumber);
                ME_SecDataFilter($sBDay);

                if(($fSalary > -1) && ($iEmployeeIndex > 0) && ($iCompanyIndex > 0) && ($iEmployeePositionIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevelIndex > 0))
                {
                    EmployeeGeneralSpecificRetriever($InDBConn, $iEmployeeIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                    $aEmployeeRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iEmployeeNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aEmployeeRow) && ($iEmployeeNumRows > 0 && $iEmployeeNumRows < 2))
                    {
                        $iEmployeeDataIndex = (int) $aEmployeeRow['EMP_DATA_ID'];

                        EmployeeEditParser($InDBConn, $iEmployeeIndex, $iEmployeePositionIndex, $iCompanyIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        EmployeeDataEditParser($InDBConn, $iEmployeeDataIndex, $sName, $sSurname, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);

                        unset($iEmployeeDataIndex);
                    }
                    else
                        throw new Exception("Could not fetch result for Company");

                    unset($aEmployeeRow, $iEmployeeNumRows);
                }
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sName, $sSurname, $sEmail, $sPhoneNumber, $sStableNumber, $sBDay, $fSalary, $iEmployeeIndex, $iCompanyIndex, $iEmployeePositionIndex, $iContentAccessIndex);
                header('Location:.?MenuIndex='.$_ENV['MenuIndex']['Employee']);
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