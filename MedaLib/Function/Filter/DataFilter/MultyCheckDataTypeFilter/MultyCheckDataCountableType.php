<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Countable
//Return false the first key it finds is not Countable
function ME_MultyCheckCountableType(...$InaVar) : bool
{
    $iArrayLenght = count($InaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_countable($InaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>