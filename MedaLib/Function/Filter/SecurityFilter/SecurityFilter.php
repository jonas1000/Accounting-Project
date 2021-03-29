<?php
function ME_SecFilterFunctionCallback(ME_CLogHandle &$InrLogHandle, string &$InFunctionCallback, int $IniUserAccessLevel, int $IniContentAccessLevel, string $InsRequestMethod = "GET") : bool
{
    if(!empty($InFunctionCallback) && is_callable($InFunctionCallback))
    {
        if((($IniUserAccessLevel - 1) < $IniContentAccessLevel) && ($_SERVER['REQUEST_METHOD'] == $InsRequestMethod))
            $InFunctionCallback($InrLogHandle);
        else
            $InrLogHandle->AddLogMessage("Function: " . $InFunctionCallback . " access error, User Access Level: " . $IniUserAccessLevel . ", requested access to content: " . $IniContentAccessLevel . ", Access Method: " . $InsRequestMethod . ", Server Request Method: " . $_SERVER['REQUEST_METHOD'] . ", User IP: " . $_SERVER["REMOTE_ADDR"] . "\n",__FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("No Function singature detected", __FILE__, __FUNCTION__, __LINE__);

    return FALSE;
}

function ME_SecFilterQueryFunctionCallback(ME_CDBConnManager &$InConn, ME_CLogHandle &$InrLogHandle, string &$InFunctionCallback, int $IniUserAccessLevel, int $IniContentAccessLevel, string $InsRequestMethod = "GET") : bool
{
    if(!empty($InFunctionCallback) && is_callable($InFunctionCallback))
    {
        if(!empty($InConn) && ($InConn instanceof ME_CDBConnManager))
        {
            if((($IniUserAccessLevel - 1) < $IniContentAccessLevel) && ($_SERVER['REQUEST_METHOD'] == $InsRequestMethod))
                $InFunctionCallback($InConn, $InrLogHandle, $IniUserAccessLevel);

            else
                $InrLogHandle->AddLogMessage("Function: " . $InFunctionCallback . " access error, User Access Level: " . $IniUserAccessLevel . ", requested access to content: " . $IniContentAccessLevel . ", Access Method: " . $InsRequestMethod . ", Server Request Method: " . $_SERVER['REQUEST_METHOD'] . ", User IP: " . $_SERVER["REMOTE_ADDR"] . "\n", __FILE__, __FUNCTION__, __LINE__);
        }
        else
            $InrLogHandle->AddLogMessage("Object of database connection type cannot be NULL", __FILE__, __FUNCTION__, __LINE__);
    }		
    else
        $InrLogHandle->AddLogMessage("No Function singature detected", __FILE__, __FUNCTION__, __LINE__);

    return FALSE;
}
?>