<?php
function CheckRange($InrData, $InrMax, $InrMin) : bool
{
    if($InrData >= $InrMin && $InrData <= $InrMax)
        return TRUE;

    return FALSE;
}
?>