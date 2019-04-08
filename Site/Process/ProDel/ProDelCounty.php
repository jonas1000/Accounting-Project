<?php
//-------------<FUNCTION>-------------//
function ProDelCounty(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['CouIndex']))
	{
		if(!empty($_POST['CouIndex']))
		{
			if(is_numeric($_POST['CouIndex']))
			{
				//variables consindered to be holding ID
				$iCountyIndex = (int) $_POST['CouIndex'];

				unset($_POST['CouIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iCountyIndex > 0) && ($IniUserAccessLevel > 0))
				{
					CountySpecificRetriever($InDBConn, $iCountyIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

					$aCountyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
					$iCountyNumRows = $InDBConn->GetResultNumRows();

					if(!empty($aCountyRow) && ($iCountyNumRows > 0 && $iCountyNumRows < 2))
					{
						$iCountyDataIndex = (int) $aCountyRow['COU_DATA_ID'];

						if($iCountyDataIndex > 0)
						{
							CountyVisParser($InDBConn, $iCountyIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							CountyDataVisParser($InDBConn, $iCountyDataIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
						}
						else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

						unset($iCountyDataIndex);
					}
					else
						throw new Exception("Could not fetch Table result");

					unset($aCountyRow, $iCountyNumRows);
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iCountyIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['County']);
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