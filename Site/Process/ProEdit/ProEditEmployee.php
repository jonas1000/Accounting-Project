<?php
function ProEditEmployee(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel)
{
    if(isset($_POST['EmployeeIndex'], $_POST['Name'], $_POST['Surname'], $_POST['Email'], $_POST['Salary'], $_POST['BDay'], $_POST['PN'], $_POST['SN'], $_POST['Company'], $_POST['EmployeePosition'], $_POST['Access']))
    {
        if(!ME_MultyCheckEmptyType($_POST['EmployeeIndex'], $_POST['Name'], $_POST['Surname'], $_POST['PN']))
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

                if(($fSalary > -1) && ($iEmployeeIndex > 0) && ($iCompanyIndex > 0) && ($iEmployeePositionIndex > 0) && ($iContentAccessIndex > 0) && ($IniUserAccessLevel > 0))
                {
                    EmployeeSpecificRetriever($InDBConn, $iEmployeeIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

                    $aEmployeeRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
                    $iEmployeeNumRows = $InDBConn->GetResultNumRows();

                    if(!empty($aEmployeeRow) && ($iEmployeeNumRows > 0 && $iEmployeeNumRows < 2))
                    {
                        $iEmployeeDataIndex = (int) $aEmployeeRow['EMP_DATA_ID'];
                        $iEmployeeAccessLevel = (int) $aEmployeeRow['EMP_ACCESS'];

                        if(($iEmployeeDataIndex > 0) && ($iEmployeeAccessLevel > 0))
                        {
                            if($iEmployeeAccessLevel > ($IniUserAccessLevel - 1))
                            {
                                EmployeeEditParser($InDBConn, $iEmployeeIndex, $iEmployeePositionIndex, $iCompanyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);

                                EmployeeDataEditParser($InDBConn, $iEmployeeDataIndex, $sName, $sSurname, $sEmail, $fSalary, $sBDay, $sPhoneNumber, $sStableNumber, $iContentAccessIndex, $_ENV['Available']['Show']);
                            }
                            else
                                throw new Exception("insufficient privilage to access content");
                        }
                        else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

                        unset($iEmployeeDataIndex, $iEmployeeAccessLevel);
                    }
                    else
                        throw new Exception("Could not fetch Table result");

                    unset($aEmployeeRow, $iEmployeeNumRows);
                }
                else
                    throw new Exception("Some variables do not meet the process requirement range, Check your variables");

                unset($sName, $sSurname, $sEmail, $sPhoneNumber, $sStableNumber, $sBDay, $fSalary, $iEmployeeIndex, $iCompanyIndex, $iEmployeePositionIndex, $iContentAccessIndex);
                header('Location:.?MenuIndex='.$_ENV['MenuIndex']['Employee']);
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