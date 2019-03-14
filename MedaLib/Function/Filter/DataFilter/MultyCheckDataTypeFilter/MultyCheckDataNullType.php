<?php
//-------------<FUNCTION>-------------//
//Take an array and check every key value is NULL
//Return false the first key it finds is not NULL
function ME_MultyCheckNullType(...$InaVar) : bool
{
  $iArrayLenght = count($InaVar);

  for($I=0; $iArrayLenght > $I; $I++)
  {
    if(!is_null($InaVar[$I]))
      return FALSE;
  }

  return TRUE;
}
?>