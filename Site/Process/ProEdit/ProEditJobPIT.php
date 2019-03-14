<?php
function ProEditJobPIT(ME_CDBConnManager &$InDBConn)
{
    if(isset($_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']))
    {
        if(ME_MultyCheckEmptyType($_POST['JobIndex'], $_POST['Date'], $_POST['Access']))
        {
            if(ME_MultyCheckNumericType($_POST['JobIndex'], $_POST['PIT'], $_POST['Access']))
            {
                $sDate = $_POST['Date'];

                $fPIT = (float) $_POST['PIT'];

                $iJobIndex = (int) $_POST['JobIndex'];
                $iContentAccessIndex = (int) $_POST['Access'];

                unset( $_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']);

                ME_SecDataFilter($sDate);

                if(($iJobIndex > 0) && ($iContentAccessIndex > 0))
                    JobPITEditParser($InDBConn, $iJobIndex, $fPIT, $iContentAccessIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Show']);
                else
                    throw new Exception("Some POST data do not meet the requirement range");

                unset($sDate, $fPIT, $iJobIndex, $iContentAccessIndex);
                header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Job']);
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