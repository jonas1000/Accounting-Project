<?php
//-------------<FUNCTION>-------------//
function ProDelCounty(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevelIndex) : void
{
	if(isset($_POST['CouIndex']))
	{
		if(ME_MultyCheckEmptyType($_POST['CouIndex'], $IniUserAccessLevelIndex))
		{
			if(is_numeric($_POST['CouIndex']))
			{
				//variables consindered to be holding ID's
				$iCountyIndex = (int) $_POST['CouIndex'];

				unset($_POST['CouIndex']);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iCountyIndex > 0)
					CountyVisParser($InDBConn, $iCountyIndex, $IniUserAccessLevelIndex, $_ENV['Available']['Hide']);
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($iCountyIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['County']);
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