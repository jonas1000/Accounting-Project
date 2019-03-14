<?php
//-------------<FUNCTION>-------------//
function ProDelCountry(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['CounIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['CounIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['CounIndex']))
			{
				//variables consindered to be holding ID's
				$iCountryIndex = (int) $_POST['CounIndex'];

				unset($_POST['CounIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iCountryIndex > 0)
					CountryVisParser($InDBConn, $iCountryIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iCountryIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Country']);
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