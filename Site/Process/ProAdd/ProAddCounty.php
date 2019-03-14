<?php
//-------------<FUNCTION>-------------//
function ProAddCounty(ME_CDBConnManager &$InDBConn)
{
	//Check if POST data exists, if not then throw a exception
	if(isset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Date'], $_POST['Access']))
	{
		//Check if POST data are NOT empty, if false then throw a exception
		if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['Access']))
		{
			//Check if POST data are numeric, if false then throw a exception
			if(ME_MultyCheckNumericType($_POST['Tax'], $_POST['IR'], $_POST['Country'], $_POST['Access']))
			{
				//take strings as is
				$sTitle = $_POST['Name'];
				$sDate = $_POST['Date'];

				//Convert data to float for logical methematical operations
				$fTax = (float) $_POST['Tax'];
				$fInterestRate = (float) $_POST['IR'];

				//variables consindered to be holding ID's
				$iCountryIndex = (int) $_POST['Country'];
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Name'], $_POST['Tax'], $_POST['IR'], $_POST['Date'], $_POST['Country'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sTitle);
				ME_SecDataFilter($sDate);

				//Limit data to a certain acceptable range
				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($fTax > -1 && $fTax < 101) && ($fInterestRate > -1 && $fInterestRate < 101) && ($iCountryIndex > 0) && ($iContentAccessIndex > 0))
				{
					CountyDataAddParser($InDBConn, $sTitle, $fTax, $fInterestRate, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);

					if($InDBConn->GetLastQueryID())
						CountyAddParser($InDBConn, $iCountryIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("Failed to get the id of last query");
				}
				else
					throw new Exception("Some POST data do not meet the requirement range");

				unset($sTitle, $fTax, $fInterestRate, $sDate, $iCountryIndex, $iContentAccessIndex);					
				header("Location:.?MenuIndex=".$_ENV['MenuIndex']['County']);
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
