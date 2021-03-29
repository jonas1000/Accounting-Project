<?php
function ME_SQLStatementExecAndResult(ME_CDBConnManager &$InrConn, mysqli_stmt &$InrStatement, ME_CLogHandle &$InrLogHandle)
{
    $rResult = 0;

    //Check if the statement was executed, else throw an exception with the error
    if($InrStatement->execute())
    {
        if($rResult = $InrStatement->get_result())
        {
            $InrConn->SetLastInsertID($InrStatement->insert_id);

            //Check if the statement was destroyed, else throw
            if(!$InrStatement->close())
                $InrLogHandle->AddLogMessage("Could not close statement", __FILE__, __METHOD__, __LINE__);
            else
                return $rResult;
        }
        else
            $InrLogHandle->AddLogMessage("Error retrieving result ".$InrStatement->errno.": ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);
    }
    else
        $InrLogHandle->AddLogMessage("Error executing query ".$InrStatement->errno.": ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);

    return FALSE;
}

function ME_SQLStatementExecAndClose(ME_CDBConnManager &$InrConn, mysqli_stmt &$InrStatement, ME_CLogHandle &$InrLogHandle)
{
    //Check if the statement was executed, else throw an exception with the error
    if($InrStatement->execute())
    {
        $InrConn->SetLastInsertID($InrStatement->insert_id);
        
        //Check if the statement was destroyed, else throw
        if(!$InrStatement->close())
            $InrLogHandle->AddLogMessage("Could not close statement", __FILE__, __FUNCTION__, __LINE__);
        else
            return TRUE;
    }
    else
        $InrLogHandle->AddLogMessage("Error executing query ".$InrStatement->errno.": ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);

    return FALSE;
}

function ME_SQLStatementExec(mysqli_stmt &$InrStatement, ME_CLogHandle &$InrLogHandle)
{
    //Check if the statement was executed, else throw an exception with the error
    if($InrStatement->execute())
        return TRUE;
    else
        $InrLogHandle->AddLogMessage("Error executing query ".$InrStatement->errno.": ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);

    return FALSE;
}
?>