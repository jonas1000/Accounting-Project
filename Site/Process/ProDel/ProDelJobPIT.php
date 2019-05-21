<?php
//-------------<FUNCTION>-------------//
function ProDelJobPIT(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['JobPITIndex']))
	{
		if(!empty($_POST['JobPITIndex']))
		{
			if(is_numeric($_POST['JobPITIndex']))
			{
				//variables consindered to be holding ID
				$iJobPITIndex = (int) $_POST['JobPITIndex'];

				unset($_POST['JobPITIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iJobPITIndex > 0) && ($IniUserAccessLevel > 0))
					JobPITVisParser($InDBConn, $iJobPITIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iJobPITIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Job']."&bIsSubOver=1");
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