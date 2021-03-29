<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is Numeric
//Return false the first key it finds is not Numeric
function ME_MultyCheckNumericType(...$InaVar) : bool
{
    $iArrayLenght = count($InaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_numeric($InaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>