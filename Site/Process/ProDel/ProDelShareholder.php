<?php
//-------------<FUNCTION>-------------//
function ProDelShareholder(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['ShareIndex']))
	{
		if(!empty($_POST['ShareIndex']))
		{
			if(is_numeric($_POST['ShareIndex']))
			{
				//variables consindered to be holding ID
				$iShareholderIndex = (int) $_POST['ShareIndex'];

				unset($_POST['ShareIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iShareholderIndex > 0) && ($IniUserAccessLevel > 0))
					ShareholderVisParser($InDBConn, $iShareholderIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iShareholderIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Shareholder']);
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