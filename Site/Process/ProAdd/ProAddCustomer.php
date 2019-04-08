<?php
//-------------<FUNCTION>-------------//
function ProAddCustomer(ME_CDBConnManager &$InDBConn)
{
	//Check if POST data exists, if not then throw a exception
	if(isset($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']))
	{
		//Check if POST data are NOT empty, if false then throw a exception
		if(!ME_MultyCheckEmptyType($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['Access']))
		{
			//Check if POST data are numeric, if false then throw a exception
			if(is_numeric($_POST['Access']))
			{
				//take strings as is
				$sName = $_POST['Name'];
				$sSurname = $_POST['Surname'];
				$sPN = $_POST['PhoneNumber'];
				$sSN = $_POST['StableNumber'];
				$sEmail = $_POST['Email'];
				$sVAT = $_POST['VAT'];
				$sAddr = $_POST['Addr'];
				$sNote = $_POST['Note'];

				//variables consindered to be holding ID's
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Name'], $_POST['Surname'], $_POST['PhoneNumber'], $_POST['StableNumber'], $_POST['Email'], $_POST['VAT'], $_POST['Addr'], $_POST['Note'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sName);
				ME_SecDataFilter($sSurname);
				ME_SecDataFilter($sPN);
				ME_SecDataFilter($sSN);
				ME_SecDataFilter($sEmail);
				ME_SecDataFilter($sVAT);
				ME_SecDataFilter($sAddr);
				ME_SecDataFilter($sNote);

				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if($iContentAccessIndex > 0)
				{
					CustomerDataAddParser($InDBConn, $sName, $sSurname, $sPN, $sSN, $sEmail, $sVAT, $sAddr, $sNote, $iContentAccessIndex, $_ENV['Available']['Show']);

					if($InDBConn->GetLastQueryID())
						CustomerAddParser($InDBConn, $iContentAccessIndex, $_ENV['Available']['Show']);
					else
						throw new Exception("Error: Failed to get the id of last query");
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");
					
				unset($sName, $sSurname, $sPN, $sSN, $sEmail, $sVAT, $sAddr, $sNote, $iContentAccessIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Customer']);
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
