<?php
//-------------<FUNCTION>-------------//
function ProDelJobPIT(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['JobIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['JobIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['JobIndex']))
			{
				//variables consindered to be holding ID's
				$iJobPITIndex = (int) $_POST['JobIndex'];

				unset($_POST['JobIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iJobPITIndex > 0)
					JobPITVisParser($InDBConn, $iJobPITIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iJobPITIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Job']."&bIsSubOver=1");
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