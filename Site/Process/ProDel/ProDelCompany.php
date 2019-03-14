<?php
//-------------<FUNCTION>-------------//
function ProDelCompany(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['CompIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['CompIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['CompIndex']))
			{
				//variables consindered to be holding ID's
				$iCompanyIndex = (int) $_POST['CompIndex'];

				unset($_POST['CompIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iCompanyIndex > 0)
					CompanyVisParser($InDBConn, $iCompanyIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iCompanyIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Company']);
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