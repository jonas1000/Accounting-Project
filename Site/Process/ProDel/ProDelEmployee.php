<?php
//-------------<FUNCTION>-------------//
function ProDelEmployee(ME_CDBConnManager &$InDBConn, int &$IniUserAccessLevel) : void
{
	if(isset($_POST['EmpIndex']))
	{
		if(!empty($_POST['EmpIndex']))
		{
			if(is_numeric($_POST['EmpIndex']))
			{
				//variables consindered to be holding ID
				$iEmployeeIndex = (int) $_POST['EmpIndex'];

				unset($_POST['EmpIndex']);

				//database cannot accept Primary or foreign keys below 1
				//If duplicate the database will throw a exception
				if(($iEmployeeIndex > 0) && ($IniUserAccessLevel > 0))
				{
					EmployeeSpecificRetriever($InDBConn, $iEmployeeIndex, $IniUserAccessLevel, $_ENV['Available']['Show']);

					$aEmployeeRow = $InDBConn->GetResultArray(MYSQLI_ASSOC);
					$iEmployeeNumRows = $InDBConn->GetResultNumRows();

					if(!empty($aEmployeeRow) && ($iEmployeeNumRows > 0 && $iEmployeeNumRows < 2))
					{
						$iEmployeeDataIndex = (int) $aEmployeeRow['EMP_DATA_ID'];

						if($iEmployeeDataIndex > 0)
						{
							EmployeeVisParser($InDBConn, $iEmployeeIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);

							EmployeeDataVisParser($InDBConn, $iEmployeeDataIndex, $IniUserAccessLevel, $_ENV['Available']['Hide']);
						}
						else
							throw new Exception("Query returned empty, did not find any ID (Possible data corruption)");

						unset($iEmployeeDataIndex);
					}
					else
						throw new Exception("Could not fetch Table result");

					unset($aEmployeeRow, $iEmployeeNumRows);
				}
				else
					throw new Exception("Some variables do not meet the process requirement range, Check your variables");

				unset($iEmployeeIndex);
				header("Location:Index.php?MenuIndex=" . $_ENV['MenuIndex']['Employee']);
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