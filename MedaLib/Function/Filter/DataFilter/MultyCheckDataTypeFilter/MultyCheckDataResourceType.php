<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a Resource
//Return false the first key it finds is not a Resource
function ME_MultyCheckResourceType(...$InaVar) : bool
{
    $iArrayLenght = count($InaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_resource($InaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>