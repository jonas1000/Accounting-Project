<?php
//-------------<FUNCTION>-------------//
function ProAddShareholder(ME_CDBConnManager &$InDBConn)
{
	if(isset($_POST['Employee'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($_POST['Employee'], $_POST['Access']))
		{
			if(is_numeric($_POST['Access']))
			{
				//variables consindered to be holding ID's
				$iEmployeeIndex = (int) $_POST['Employee'];
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Employee'], $_POST['Access']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($iEmployeeIndex > 0 && $iContentAccessIndex > 0))
					ShareholderAddParser($InDBConn, $iEmployeeIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
				else
					throw new Exception("Some POST data do not meet the requirement range");
					
				unset($iEmployeeIndex, $iContentAccessIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Shareholder']);
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
