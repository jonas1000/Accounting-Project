<?php
function ME_StatementQueryCheck(mysqli_stmt &$InrStatement, ME_CLogHandle &$InrLogHandle) : void
{
    if(!$InrStatement)
            $InrLogHandle->AddLogMessage($InrStatement->errno . " - ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);

    if(!$InrStatement->execute())
    $InrLogHandle->AddLogMessage($InrStatement->errno . " - ".$InrStatement->error, __FILE__, __FUNCTION__, __LINE__);
}

?>