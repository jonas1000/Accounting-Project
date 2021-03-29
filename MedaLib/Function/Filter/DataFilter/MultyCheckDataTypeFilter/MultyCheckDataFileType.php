<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a File
//Return false the first key it finds is not a File
function ME_MultyCheckFileType(string ...$InsaVar) : bool
{
    $iArrayLenght = count($InsaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_file($InsaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>