<?php
//-------------<FUNCTION>-------------//
function ProDelCustomer(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['CustIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['CustIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['CustIndex']))
			{
				//variables consindered to be holding ID's
				$iCustomerIndex = (int) $_POST['CustIndex'];

				unset($_POST['CustIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iCustomerIndex > 0)
					VisCustomerParser($InDBConn, $iCustomerIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iCustomerIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Customer']);
			}
			else 
                throw new Exception("Some POST data are not considered numeric type");
		}
		else
			throw new Exception("Some POST data are empty, Those POST cannot be empty");
	}
	else
		throw new Exception("Missing POST data to complete transaction");
}
?>