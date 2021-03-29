<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is a Directory
//Return false the first key it finds is not a Directory
function ME_MultyCheckDirType(string ...$InsaVar) : bool
{
    $iArrayLenght = count($InsaVar);

    for($I=0; $iArrayLenght > $I; $I++)
    {
        if(!is_dir($InsaVar[$I]))
            return FALSE;
    }

    return TRUE;
}
?>