<?php
//-------------<FUNCTION>-------------//
function ProAddJob(ME_CDBConnManager &$InDBConn)
{
	if(isset($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Access']))
	{
	 	if(!ME_MultyCheckEmptyType($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Access']))
		{
			if(ME_MultyCheckNumericType($_POST['Company'], $_POST['Access']))
			{
				//take strings as is
				$sName = $_POST['Name'];
				$sDate = $_POST['Date'];

				//Convert data to float for logical methematical operations
				$fPrice = (float) $_POST['Price'];
				$fPIA = (float) $_POST['PIA'];
				$fExpenses = (float) $_POST['Expenses'];
				$fDamage = (float) $_POST['Damage'];

				//variables consindered to be holding ID's
				$iCompanyIndex = (int) $_POST['Company'];
				$iContentAccessIndex = (int) $_POST['Access'];

				unset($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Access']);

				//format the string to be compatible with HTML and avoid SQL injection
				ME_SecDataFilter($sName);
				ME_SecDataFilter($sDate);

				//Limit data to a certain acceptable range
				//database cannot accept Primary or foreighn keys below 1
				//If duplicate the database will throw a exception
				if(($fPIA > -1) && ($iCompanyIndex > 0) && ($iContentAccessIndex > 0))
				{
					JobOutcomeAddParser($InDBConn, $fExpenses, $fDamage, $iContentAccessIndex, $_ENV['Available']['Show']);

					$iLastQueryOutcomeIndex = $InDBConn->GetLastQueryID();

					if($iLastQueryOutcomeIndex)
					{

						JobIncomeAddParser($InDBConn, $fPrice, $fPIA, $iContentAccessIndex, $_ENV['Available']['Show']);

						$iLastQueryIncomeIndex = $InDBConn->GetLastQueryID();

						if($iLastQueryIncomeIndex)
						{

							JobDataAddParser($InDBConn, $sName, $sDate, $iContentAccessIndex, $_ENV['Available']['Show']);

							if($InDBConn->GetLastQueryID())
							{
								JobAddParser($InDBConn, $iLastQueryOutcomeIndex, $iLastQueryIncomeIndex, $iCompanyIndex, $iContentAccessIndex, $_ENV['Available']['Show']);
							}
							else
								throw new Exception("Failed to get id from last query");
						}
						else
							throw new Exception("Failed to get id from last query");
					}
					else
						throw new Exception("Failed to get id from last query");
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");
					
				unset($iCompanyIndex, $sName, $sDate, $fPrice, $fPIA, $fExpenses, $fDamage, $iContentAccessIndex);
				header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Job']);
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
