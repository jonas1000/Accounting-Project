<?php
function CheckAccessRange($InrDataToCheck) : bool
{
    if($InrDataToCheck >= $GLOBALS['ACCESS']['ADMIN'] && $InrDataToCheck <= end($GLOBALS['ACCESS']))
        return TRUE;

    return FALSE;
}

?>