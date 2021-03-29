<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is an array
//Return false the first key it finds is not an array
function ME_MultyCheckArrayType(...$InaVar) : bool
{
    $iArrayLenght = count($InaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_array($InaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>