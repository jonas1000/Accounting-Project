<?php
//-------------<FUNCTION>-------------//
function ProDelShareholder(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['ShareIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['ShareIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['ShareIndex']))
			{
				//variables consindered to be holding ID's
				$iShareholderIndex = (int) $_POST['ShareIndex'];

				unset($_POST['ShareIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iShareholderIndex > 0)
					ShareholderVisParser($InDBConn, $iShareholderIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iShareholderIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Shareholder']);
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