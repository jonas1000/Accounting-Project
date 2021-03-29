<?php
function CheckAccessRange($InrDataToCheck) : bool
{
    if($InrDataToCheck >= $GLOBALS['ACCESS']['Admin'] && $InrDataToCheck <= $GLOBALS['ACCESS_ARRAY_SIZE'])
        return TRUE;

    return FALSE;
}

?>