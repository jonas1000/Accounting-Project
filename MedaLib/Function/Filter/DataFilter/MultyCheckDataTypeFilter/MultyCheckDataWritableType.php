<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Writable
//Return false the first key it finds is not Writable
function ME_MultyCheckWritableType(string ...$InsaVar) : bool
{
    $iArrayLenght = count($InsaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_writable($InsaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>