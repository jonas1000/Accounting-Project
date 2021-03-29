<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Callable
//Return false the first key it finds is not Callable
function ME_MultyCheckCallableType(...$InaVar) : bool
{
    $iArrayLenght = count($InaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_callable($InaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>