<?php
function ProEditShareholder(ME_CDBConnManager &$InDBConn)
{
    if(isset($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['ShareIndex'], $_POST['Employee'], $_POST['Access']))
            {
                $iShareholderIndex = (int) $_POST['ShareIndex'];
                $iEmployeeIndex = (int) $_POST['Employee'];
                $iContentAccessIndex = (int) $_POST['Access'];

                if(($iShareholderIndex > 0) && ($iEmployeeIndex > 0) && ($iContentAccessIndex > 0))
                    ShareholderEditParser($InDBConn, $iShareholderIndex, $iEmployeeIndex, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($iShareholderIndex, $iEmployeeIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Shareholder']);
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