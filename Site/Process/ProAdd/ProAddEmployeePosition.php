<?php
//-------------<FUNCTION>-------------//
function ProAddEmployeePosition(ME_CDBConnManager &$InDBConn)
{
	if(isset($_POST['Name'], $_POST['Access']))
	{
		if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Access']))
		{
			if(is_numeric($_POST['Access']))
			{
				//take strings as is
				$sName = $_POST['Name'];
				
				//variables consindered to be holding ID's
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Name'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sName);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iContentAccessIndex > 0)
					EmployeePositionAddParser($InDBConn, $sName, $iContentAccessIndex, $_ENV['Available']['Show']);
				else
					throw new Exception("Some POST data do not meet the requirement range");
					
				unset($sName, $iContentAccessIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['EmployeePosition']);
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
