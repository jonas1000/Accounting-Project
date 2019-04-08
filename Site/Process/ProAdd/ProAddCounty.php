<?php
//-------------<FUNCTION>-------------//
function ProAddCounty(ME_CDBConnManager &$InDBConn)
{
	//Check if POST data exists, if not then throw a exception
	if(isset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Access']))
	{
		//Check if POST data are NOT empty, if false then throw a exception
		if(!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Access']))
		{
			//Check if POST data are numeric, if false then throw a exception
			if(ME_MultyCheckNumericType($_POST['Country'], $_POST['Access']))
			{
				//take strings as is
				$sTitle = $_POST['Name'];

				//Convert data to float for logical methematical operations
				$fTax = (float) $_POST['Tax'];
				$fInterestRate = (float) $_POST['IR'];

				//variables consindered to be holding ID's
				$iCountryIndex = (int) $_POST['Country'];
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Country'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sTitle);

				//Limit data to a certain acceptable range
				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($iCountryIndex > 0) && ($iContentAccessIndex > 0))
				{
					CountyDataAddParser($InDBConn, $sTitle, $fTax, $fInterestRate, $iContentAccessIndex, $_ENV['Available']['Show']);

					if($InDBConn->GetLastQueryID())
						CountyAddParser($InDBConn, $iCountryIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("Failed to get the id of last query");
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($sTitle, $fTax, $fInterestRate, $sDate, $iCountryIndex, $iContentAccessIndex);					
				header("Location:.?MenuIndex=".$_ENV['MenuIndex']['County']);
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
