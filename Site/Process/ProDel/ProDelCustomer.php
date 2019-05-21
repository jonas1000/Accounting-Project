<?php
//-------------<FUNCTION>-------------//
function ProDelCustomer(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['CustIndex']))
	{
		if(!empty($_POST['CustIndex']))
		{
			if(is_numeric($_POST['CustIndex']))
			{
				//variables consindered to be holding ID
				$iCustomerIndex = (int) $_POST['CustIndex'];

				unset($_POST['CustIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iCustomerIndex > 0) && ($IniUserAccessLevel > 0))
				{
					CustomerSpecificRetriever($InDBConn, $iCustomerIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

					$aCustomerRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
					$iCustomerNumRows = $InDBConn->GetResultNumRows();

					if(!empty($aCustomerRow) && ($iCustomerNumRows > 0 && $iCustomerNumRows < 2))
					{
						$iCustomerDataIndex = (int) $aCustomerRow['CUST_DATA_ID'];

						if($iCustomerDataIndex > 0)
						{
							CustomerVisParser($InDBConn, $iCustomerIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							CustomerDataVisParser($InDBConn, $iCustomerDataIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
						}
						else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

						unset($iCustomerDataIndex);
					}
					else
						throw new Exception("Could not fetch Table result");

					unset($aCustomerRow, $iCustomerNumRows);
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iCustomerIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Customer']);
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