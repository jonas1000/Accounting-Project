<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Float
//Return false the first key it finds is not Float
function ME_MultyCheckFloatType(...$InaVar) : bool
{
    $iArrayLenght = count($InaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_float($InaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>