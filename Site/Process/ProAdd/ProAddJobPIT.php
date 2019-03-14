<?php
//-------------<FUNCTION>-------------//
function ProAddJobPIT(ME_CDBConnManager &$InDBConn)
{
	if(isset($_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($_POST['JobIndex'], $_POST['Date'], $_POST['Access']))
		{
			if(ME_MultyCheckNumericType($_POST['JobIndex'], $_POST['Access']))
			{
				//take strings as is
				$sDate = $_POST['Date'];

				//Convert data to float for logical methematical operations
				$fPayment = (float) $_POST['PIT'];

				//variables consindered to be holding ID's
				$iJobIndex = (int) $_POST['JobIndex'];
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['JobIndex'], $_POST['PIT'], $_POST['Date'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sDate);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($iJobIndex > 0) && ($iContentAccessIndex > 0))
					JobPitAddParser($InDBConn, $iJobIndex, $fPayment, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);
				else
					throw new Exception("Some POST data do not meet the requirement range");
					
				unset($iJobIndex, $fPayment, $sDate, $iContentAccessIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Job']);
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
