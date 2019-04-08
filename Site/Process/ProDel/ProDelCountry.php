<?php
//-------------<FUNCTION>-------------//
function ProDelCountry(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['CounIndex']))
	{
		if(!empty($_POST['CounIndex']))
		{
			if(is_numeric($_POST['CounIndex']))
			{
				//variables consindered to be holding ID
				$iCountryIndex = (int) $_POST['CounIndex'];

				unset($_POST['CounIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iCountryIndex > 0) && ($IniUserAccessLevel > 0))
				{
					CountrySpecificRetriever($InDBConn, $iCountryIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

					$aCountryRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
					$iCountryNumRows = $InDBConn->GetResultNumRows();

					if(!empty($aCountryRow) && ($iCountryNumRows > 0 && $iCountryNumRows < 2))
					{
						$iCountryDataIndex = (int) $aCountryRow['COUN_DATA_ID'];

						if($iCountryDataIndex > 0)
						{
							CountryVisParser($InDBConn, $iCountryIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							CountryDataVisParser($InDBConn, $iCountryDataIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
						}
						else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

						unset($iCountryDataIndex);
					}
					else
						throw new Exception("Could not fetch Table result");
						
					unset($aCountryRow, $iCountryNumRows);
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iCountryIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Country']);
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