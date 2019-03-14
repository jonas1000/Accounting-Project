<?php
//-------------<FUNCTION>-------------//
function ProAddCompany(ME_CDBConnManager &$InDBConn)
{
	//Check if POST data exists, if not then throw a exception
	if(isset($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']))
	{
		//Check if POST data are NOT empty, if false then throw a exception
		if(ME_MultyCheckEmptyType($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']))
		{
			//Check if POST data are numeric, if false then throw a exception
			if(ME_MultyCheckNumericType($_POST['Access'], $_POST['County']))
			{
				//take strings as is
				$sName = $_POST['Name'];
				$sDate = $_POST['Date'];

				//variables consindered to be holding ID's
				$iContentAccessIndex = (int) $_POST['Access'];
				$iCountyIndex = (int) $_POST['County'];

				unset($_POST['Name'], $_POST['Date'], $_POST['Access'], $_POST['County']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sName);
				ME_SecDataFilter($sDate);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($iContentAccessIndex > 0) && ($iCountyIndex > 0))
				{
					CompanyDataAddParser($InDBConn, $sName, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);

					if($InDBConn->GetLastQueryID())
						CompanyAddParser($InDBConn, $iCountyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("Coulnd't get last query id");
				}
				else
					throw new Exception("Some POST data do not meet the requirement range");
					
				unset($sName, $sDate, $iContentAccessIndex, $iCountyIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Company']);
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