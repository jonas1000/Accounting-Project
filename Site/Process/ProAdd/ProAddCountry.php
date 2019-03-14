<?php
//-------------<FUNCTION>-------------//
function ProAddCountry(ME_CDBConnManager &$InDBConn)
{
	//Check if POST data exists, if not then throw a exception
	if(isset($_POST['Name'], $_POST['Access']))
	{
		//Check if POST data are NOT empty, if false then throw a exception
		if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Access']))
		{
			//Check if POST data are numeric, if false then throw a exception
			if(is_numeric($_POST['Access']))
			{
				//take strings as is
				$sTitle = $_POST['Name'];

				//variables consindered to be holding ID's
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Name'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sTitle);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iContentAccessIndex > 0)
				{
					CountryDataAddParser($InDBConn, $sTitle, $iContentAccessIndex, $_ENV['Available']['Show']);

					if($InDBConn->GetLastQueryID())
						CountryAddParser($InDBConn, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("Error: Failed to get the id of last query");
				}
				else
					throw new Exception("Some POST data do not meet the requirement range");
					
				unset($sTitle, $iContentAccessIndex);
				header("Location:.?MenuIndex=".$_ENV['MenuIndex']['Country']);
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
