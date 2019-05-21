<?php
function ME_SecFilterFunctionCallback(string $InFunctionCallback, int $IniUserAccessLevel, int $IniContentAccessLevel, string $InsRequestMethod = "GET") : void
{
	if(!empty($InFunctionCallback))
	{
		if(!empty($IniUserAccessLevel))
		{
			if(is_callable($InFunctionCallback))
			{
				if((($IniUserAccessLevel - 1) < $IniContentAccessLevel) && ($_SERVER['REQUEST_METHOD'] == $InsRequestMethod))
					$InFunctionCallback();
				else
					throw new Exception("Function: " . $InFunctionCallback . " access error, User Access Level: " . $IniUserAccessLevel . ", requested access to content: " . $IniContentAccessLevel . ", Access Method: " . $InsRequestMethod . ", Server Request: " . $_SERVER['REQUEST_METHOD'] . ", User IP: " . $_SERVER["REMOTE_ADDR"] . "\n");
			}
			else
				throw new Exception("Function callback: " . $InFunctionCallback . " is uncallable");
		}
		else
			throw new Exception("User access ID is NULL, User access ID must never be NULL");
	}
	else
		throw new Exception("No Function Callback detected");
}

function ME_SecFilterQueryFunctionCallback(ME_CDBConnManager &$InDBConn, string $InFunctionCallback, int $IniUserAccessLevel, int $IniContentAccessLevel, string $InsRequestMethod = "GET") : void
{
	if(!empty($InFunctionCallback))
	{
		if(!empty($IniUserAccessLevel))
		{
			if(is_callable($InFunctionCallback))
			{
				if(!empty($InDBConn))
				{
					if(($InDBConn instanceof ME_CDBConnManager))
					{
						if((($IniUserAccessLevel - 1) < $IniContentAccessLevel) && ($_SERVER['REQUEST_METHOD'] == $InsRequestMethod))
							$InFunctionCallback($InDBConn, $IniUserAccessLevel);
						else
							throw new Exception("Function: " . $InFunctionCallback . " access error, User Access Level: " . $IniUserAccessLevel . ", requested access to content: " . $IniContentAccessLevel . ", Access Method: " . $InsRequestMethod . ", Server Request: " . $_SERVER['REQUEST_METHOD'] . ", User IP: " . $_SERVER["REMOTE_ADDR"] . "\n");
					}
					else
						throw new Exception("Object Type is not an instance of ME_CDBConnManager");
				}
				else
					throw new Exception("Object of database connection type cannot be NULL");
			}
			else
				throw new Exception("Function callback: " . $InFunctionCallback . " is uncallable");
		}
		else
			throw new Exception("User access ID is NULL, User access ID must never be NULL");
	}
	else
		throw new Exception("No Function Callback detected");
}
?>