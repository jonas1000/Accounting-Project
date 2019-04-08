<?php
//-------------<FUNCTION>-------------//
function ProDelCompany(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['CompIndex']))
	{
		if(!empty($_POST['CompIndex']))
		{
			if(is_numeric($_POST['CompIndex']))
			{
				//variables consindered to be holding ID
				$iCompanyIndex = (int) $_POST['CompIndex'];

				unset($_POST['CompIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iCompanyIndex > 0) && ($IniUserAccessLevel > 0))
				{
					CompanySpecificRetriever($InDBConn, $iCompanyIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

					$aCompanyRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
					$iCompanyNumRows = $InDBConn->GetResultNumRows(); 

					if(!empty($aCompanyRow) && ($iCompanyNumRows > 0 && $iCompanyNumRows < 2))
					{
						$iCompanyDataIndex = (int) $aCompanyRow['COMP_DATA_ID'];

						if($iCompanyDataIndex > 0)
						{
							CompanyVisParser($InDBConn, $iCompanyIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							CompanyDataVisParser($InDBConn, $iCompanyDataIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
						}
						else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

						unset($iCompanyDataIndex);
					}
					else
						throw new Exception("Could not fetch Table result");

					unset($aCompanyRow, $iCompanyNumRows);
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iCompanyIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Company']);
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