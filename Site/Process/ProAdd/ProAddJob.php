<?php
function ProAddJob(CDBConnManager &$InDBConn)
{
	if(isset($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Access']))
	{
	 	if(ME_MultyCheckEmptyType($InDBConn, $_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Access']))
		{
			$sCompany = $_POST['Company'];
			$sName = $_POST['Name'];
			$sDate = $_POST['Date'];
			$sPrice = $_POST['Price'];
			$sPIA = $_POST['PIA'];
			$sExpenses = $_POST['Expenses'];
			$sDamage = $_POST['Damage'];
			$sAccess = $_POST['Access'];

			ME_SecDataFilter($sCompany);
			ME_SecDataFilter($sName);
			ME_SecDataFilter($sDate);
			ME_SecDataFilter($sPrice);
			ME_SecDataFilter($sPIA);
			ME_SecDataFilter($sExpenses);
			ME_SecDataFilter($sDamage);
			ME_SecDataFilter($sAccess);

			$fPrice = (float) $sPrice;
			$fPIA = (float) $sPIA;
			$fExpenses = (float) $sExpenses;
			$fDamage = (float) $sDamage;
			$iCompanyIndex = (int) $sCompany;
			$iAccessIndex = (int) $sAccess;

			unset($sPrice, $sPIA, $sExpenses, $sDamage, $sAccess);

			JobOutcomeAddParser($InDBConn, $fExpenses, $fDamage, $iAccessIndex, $_ENV['Available']['Show']);

			$iLastQueryOutcomeIndex = $InDBConn->GetLastQueryID();

			if($iLastQueryOutcomeIndex)
			{

				JobIncomeAddParser($InDBConn, $fPrice, $fPIA, $iAccessIndex, $_ENV['Available']['Show']);

				$iLastQueryIncomeIndex = $InDBConn->GetLastQueryID();

				if($iLastQueryIncomeIndex)
				{

					JobDataAddParser($InDBConn, $sName, $sDate, $iAccessIndex, $_ENV['Available']['Show']);

					if($InDBConn->GetLastQueryID())
					{
						JobAddParser($InDBConn, $iLastQueryOutcomeIndex, $iLastQueryIncomeIndex, $iCompanyIndex, $iAccessIndex, $_ENV['Available']['Show']);
					}
					else
						throw new Exception("Failed to get id from last query");
				}
				else
					throw new Exception("Failed to get id from last query");
			}
			else
				throw new Exception("Failed to get id from last query");

			unset($iCompanyIndex, $sName, $sDate, $fPrice, $fPIA, $fExpenses, $fDamage, $iAccessIndex);
			unset($_POST['Company'], $_POST['Name'], $_POST['Date'], $_POST['Price'], $_POST['PIA'], $_POST['Expenses'], $_POST['Damage'], $_POST['Access']);

			header("Location:Index.php?MenuIndex=".$_ENV['MenuIndex']['Job']);
		}
		else
			throw new Exception("Missing POST data to complete transaction");
	}
	else
		throw new Exception("Some POST data are not initialized");
}
?>
